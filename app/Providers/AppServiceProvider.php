<?php

namespace App\Providers;

use App\Barrio;
use App\Parcela;
use App\Bonificacion;
use App\Direccion;
use App\Mejora;
use App\TipoMejora;
use App\TipoMejoraDestino;
use App\TipoPersonaParcela;
use App\TipoCondicion;
use App\TipoInstrumento;
use App\TipoParcela;
use App\TipoProfesional;
use App\TipoServicio;
use App\Persona;
use App\Seccion;
use App\User;
use App\PersonaParcela;
use App\TipoAfectacion;
use App\TipoDocumento;
use App\UnionDesglose;
use App\Tramite;
use App\Observers\ParcelaAuditoria;
use App\Observers\BarrioAuditoria;
use App\Observers\BonificacionAuditoria;
use App\Observers\DireccionAuditoria;
use App\Observers\MejoraAuditoria;
use App\Observers\TipoMejoraAuditoria;
use App\Observers\TipoMejoraDestinoAuditoria;
use App\Observers\TipoPersonaParcelaAuditoria;
use App\Observers\TipoCondicionAuditoria;
use App\Observers\TipoInstrumentoAuditoria;
use App\Observers\TipoParcelaAuditoria;
use App\Observers\TipoProfesionalAuditoria;
use App\Observers\TipoServicioAuditoria;
use App\Observers\TramiteAuditoria;
use App\Observers\PersonaAuditoria;
use App\Observers\PersonaParcelaAuditoria;
use App\Observers\SeccionAuditoria;
use App\Observers\TipoAfectacionAuditoria;
use App\Observers\TipoDocumentoAuditoria;
use App\Observers\TipoRyBAuditoria;
use App\Observers\UnionDesgloseAuditoria;
use App\Observers\UsuarioAuditoria;
use App\TipoParcelaRyB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        Barrio::observe(BarrioAuditoria::class);
        Bonificacion::observe(BonificacionAuditoria::class);
        Direccion::observe(DireccionAuditoria::class);
        Mejora::observe(MejoraAuditoria::class);
        Parcela::observe(ParcelaAuditoria::class);
        Persona::observe(PersonaAuditoria::class);
        PersonaParcela::observe(PersonaParcelaAuditoria::class);
        Seccion::observe(SeccionAuditoria::class);
        TipoAfectacion::observe(TipoAfectacionAuditoria::class);
        TipoCondicion::observe(TipoCondicionAuditoria::class);
        TipoDocumento::observe(TipoDocumentoAuditoria::class);
        TipoInstrumento::observe(TipoInstrumentoAuditoria::class);
        TipoMejora::observe(TipoMejoraAuditoria::class);
        TipoMejoraDestino::observe(TipoMejoraDestinoAuditoria::class);
        TipoParcela::observe(TipoParcelaAuditoria::class);
        TipoPersonaParcela::observe(TipoPersonaParcelaAuditoria::class);
        TipoProfesional::observe(TipoProfesionalAuditoria::class);
        TipoServicio::observe(TipoServicioAuditoria::class);
        UnionDesglose::observe(UnionDesgloseAuditoria::class);
        Tramite::observe(TramiteAuditoria::class);
        TipoParcelaRyB::observe(TipoRyBAuditoria::class);
        User::observe(UsuarioAuditoria::class);
    }
}
