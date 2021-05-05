<?php

namespace App\Http\Controllers;

use App\ParcelaDocumento;
use App\Parcela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;


class ParcelaDocumentoController extends Controller
{
     private $ubicacion_archivos = 'storage/archivos/parceladocs'; 

   public function __construct()
   {
       $this->middleware('auth');
   }

   public function index(Request $request)
   {           
        return view('gestion.padron.documentos.index');  
   }

   public function store(Request $request)
   {   
         


        if($request->hasFile('parcela_document_archivo')){//si hay un archivo cargado

              
               $ParcelaDocumento = new ParcelaDocumento();
               $ParcelaDocumento->parcela_id = $request->parcela_id;
               $ParcelaDocumento->parcela_document_origen = $request->parcela_document_origen;
               $ParcelaDocumento->parcela_document_f_origen = $request->parcela_document_f_origen;
               $ParcelaDocumento->parcela_document_expediente = $request->parcela_document_expediente;
               $ParcelaDocumento->seccion_id = $request->seccion_id;
               $ParcelaDocumento->parcela_document_descrip = $request->parcela_document_descrip;        
               $ParcelaDocumento->tipo_regimen_id = $request->tipo_regimen_id;
               $ParcelaDocumento->tipo_doc_id = $request->tipo_doc_id;
               $ParcelaDocumento->parcela_document_f_proc = date("Y-m-d H:i:s");
               $ParcelaDocumento->usuario_id = $this->CCGetUserID();
               $usuario_id = $this->CCGetUserID();
               $file = $request->file('parcela_document_archivo');
               $nombre_real = $file->getClientOriginalName();//nombre completo con la extensión
               $nombre_alternativo = str_replace(" ","_",$nombre_real);
               $nombre_alternativo = $usuario_id."___".$nombre_alternativo;
               $Parcela = Parcela::select('parcela_padron')->where('parcela_id','=',$ParcelaDocumento->parcela_id)->get();
               $parcela_padron = $Parcela[0]->parcela_padron;
               //ubicacion: /var/www/html/desarrollo_catastro/public/storage/archivos/parceladocs/{nro_padron}
               $path = public_path($this->ubicacion_archivos)."/".$parcela_padron;
               if(!File::exists($path)) {//existe el directorio del padron?
                    File::makeDirectory($path);//sino existe crear directorio
               }
               $parcela_document_archivo = "/".$parcela_padron."/".$nombre_alternativo;               
               Storage::disk('parceladocs')->putFileAs($parcela_padron,$file,$nombre_alternativo);//guarda el archivo segun filesystems.php
               //\File::put($path."/".$nombre_alternativo,$file);//->no usar este ya que se pierde el formato del archivo al guardar
               //$path = $request->file('parcela_document_archivo')->storeAs($path,$parcela_document_archivo,'parceladocs');
               $ParcelaDocumento->parcela_document_archivo = $parcela_document_archivo;
               $ParcelaDocumento->parcela_document_original = $nombre_real;
               $ParcelaDocumento->save();
          }
          session(['redirectElement' => 'regimenes']);
          return back()->with("success","Agregado exitosamente");//vuelve a la misma pagina
   }

   public function update(Request $request)
   {
     $ParcelaDocumento = ParcelaDocumento::findOrFail($request->parcela_document_id);
     $ParcelaDocumento->update($request->all());
     $ParcelaDocumento->parcela_document_f_proc = date("Y-m-d H:i:s");
     $ParcelaDocumento->usuario_id = $this->CCGetUserID();
     $ParcelaDocumento->save();

     session(['redirectElement' => 'regimenes']);
     return back()->with("success","Actualizado exitosamente");
   }

   public function baja(Request $request)
   {//eliminar registro y archivo
          $parcela_document_id = $request->parcela_document_id;
          $realizado = false;
         
          //MARCAR DAR DE BAJA
          $parceladocumento = ParcelaDocumento::findOrFail($parcela_document_id);
          $parceladocumento->tipo_estado = 2;
          $parceladocumento->update();
          $realizado = true;
          session(['redirectElement' => 'regimenes']);
          return Response::json(array( "eliminado" => $realizado), 200);
   }
   public function archivo(Request $request)
   {//reemplazar archivo por otro en el registro 



          if($request->hasFile('parcela_document_archivo')){//si viene archivo
               $parcela_document_id = $request->parcela_document_id2;
               if($this->eliminar_archivo($parcela_document_id)){//si elimino el archivo viejo
                    //cargar el nuevo en reemplazo
                    $ParcelaDocumento = ParcelaDocumento::findOrFail($parcela_document_id);
                    $usuario_id = $this->CCGetUserID();
                    $file = $request->file('parcela_document_archivo');
                    $nombre_real = $file->getClientOriginalName();//nombre completo con la extensión
                    $nombre_alternativo = str_replace(" ","_",$nombre_real);
                    $nombre_alternativo = $usuario_id."___".$nombre_alternativo;
                    $Parcela = Parcela::select('parcela_padron')->where('parcela_id','=',$ParcelaDocumento->parcela_id)->get();
                    $parcela_padron = $Parcela[0]->parcela_padron;
                    $parcela_document_archivo = "/".$parcela_padron."/".$nombre_alternativo;               
                    Storage::disk('parceladocs')->putFileAs($parcela_padron,$file,$nombre_alternativo);//guarda el archivo segun filesystems.php
                    $ParcelaDocumento->parcela_document_archivo = $parcela_document_archivo;
                    $ParcelaDocumento->parcela_document_original = $nombre_real;
                    $ParcelaDocumento->parcela_document_f_proc = date("Y-m-d H:i:s");
                    $ParcelaDocumento->usuario_id = $this->CCGetUserID();
                    $ParcelaDocumento->save();
                    session(['redirectElement' => 'regimenes']);
                    return back()->with("success","Actualizado exitosamente");
               }else{
                    session(['redirectElement' => 'regimenes']);
                    return back()->with("error","No se borro el archivo");
               }               
          }else{
               session(['redirectElement' => 'regimenes']);
               return back()->with("error","Actualizado exitosamente");
          }          
   }
   private function eliminar_archivo($parcela_document_id){//accion de eliminar archivo
     $parceladocumento = ParcelaDocumento::select('*')->where('parcela_document_id','=',$parcela_document_id)->get();
     $documento = $parceladocumento[0];
     $archivo_fisico = $documento->parcela_document_archivo;
     $path = public_path($this->ubicacion_archivos);
     $archivo_ubicacion = $path.$archivo_fisico;
     //---------------------borrar archivo-------------------------
     $realizado = false;
     if(file_exists($archivo_ubicacion)) {//si existe el archivo procede a la eliminacion del mismo y del registro
          if(unlink($archivo_ubicacion)){//si elimino efectivamente el archivo
               $realizado = true;
          }
     }
     return $realizado;
   }
   
   private function guardar_archivo($archivo){
     //accion de guardar archivo
     $valor = true;
     return $valor;
   }
}