<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
 
 // Inicio
 Breadcrumbs::for('home', function ($trail) {
     $trail->push('Inicio', route('home'));
 });
  
  // Inicio > Cartografía
  Breadcrumbs::for('cartografia', function ($trail) {
    $trail->parent('home');
    $trail->push('Cartografía', route('cartografia'));
});

  // Inicio > Cartografía
  Breadcrumbs::for('cartografia_reporte', function ($trail) {
    $trail->parent('home');
    $trail->push('Cartografía Reporte', route('cartografia'));
});

  // Inicio > Usuarios
  Breadcrumbs::for('user', function ($trail) {
    $trail->parent('home');
    $trail->push('Gestión de Usuarios', route('user'));
});

  // Inicio > Seccion
  Breadcrumbs::for('seccion', function ($trail) {
    $trail->parent('home');
    $trail->push('Gestión de Secciones', route('seccion'));
});

  // Inicio > Bloqueos
  Breadcrumbs::for('Bloqueo', function ($trail) {
    $trail->parent('home');
    $trail->push('Gestión de Bloqueos', route('bloqueo'));
});

  // ADMINISTRACION DE PARCELAS

  // Inicio > Tipo_de_condicion
  Breadcrumbs::for('tipo_de_condicion', function ($trail) {
    $trail->parent('home');
    $trail->push('Tipos de Condiciones', route('tipo_de_condicion'));
});

  // Inicio > Tipo_de_instrumento
  Breadcrumbs::for('tipo_de_instrumento', function ($trail) {
    $trail->parent('home');
    $trail->push('Tipos de Instrumentos', route('tipo_de_instrumento'));
});

  // Inicio > Tipo_de_parcela
  Breadcrumbs::for('tipo_de_parcela', function ($trail) {
    $trail->parent('home');
    $trail->push('Tipos de Parcelas', route('tipo_de_parcela'));
});

  // Inicio > Tipo_de_profesional
  Breadcrumbs::for('tipo_de_profesional', function ($trail) {
    $trail->parent('home');
    $trail->push('Tipos de Profesional', route('tipo_de_profesional'));
});

  // Inicio > Tipo_de_servicio
  Breadcrumbs::for('tipo_de_servicio', function ($trail) {
    $trail->parent('home');
    $trail->push('Tipos de Servicio', route('tipo_de_servicio'));
});

  // Inicio > Poligonos sin padron
  Breadcrumbs::for('poligonos_sin_padron', function ($trail) {
    $trail->parent('home');
    $trail->push('Polígonos sin Padrones', route('poligonos_sin_padrones'));
});

  // ADMINISTRACION DE AVALUO

  // Inicio > Tipo_de_mejora
  Breadcrumbs::for('config_calc_avaluo', function ($trail) {
    $trail->parent('home');
    $trail->push('Configuracion Calculo de Avaluo', route('config_calc_avaluo'));
});

Breadcrumbs::for('config_utm', function ($trail) {
  $trail->parent('home');
  $trail->push('Configuracion de UTM', route('config_utm'));
});

  // ADMINISTRACION DE MEJORAS

    // Inicio > Tipo_de_mejora
    Breadcrumbs::for('tipo_de_mejora', function ($trail) {
      $trail->parent('home');
      $trail->push('Tipos de Mejoras', route('tipo_de_mejora'));
  });    
  
  // Inicio > Tipo_de_tramite
    Breadcrumbs::for('tipo_de_tramite', function ($trail) {
      $trail->parent('home');
      $trail->push('Tipos de Tramites', route('tipo_de_tramite'));
  });

     // Inicio > Tipo_de_mejora_destino
     Breadcrumbs::for('tipo_de_mejora_destino', function ($trail) {
      $trail->parent('home');
      $trail->push('Tipos de Mejoras Destinos', route('tipo_de_mejora_destino'));
  });


  // ADMINISTRACION DE PERSONAS

    // Inicio > Tipo_de_documento
    Breadcrumbs::for('tipo_de_documento', function ($trail) {
      $trail->parent('home');
      $trail->push('Tipos de Documentos', route('tipo_de_documento'));
  });
  
    // Inicio > Tipo_de_persona_parcela
    Breadcrumbs::for('tipo_de_persona_parcela', function ($trail) {
      $trail->parent('home');
      $trail->push('Tipos de Personas Parcelas', route('tipo_de_persona_parcela'));
  });

  // ADMINISTRACION DE AFECTACIONES

    // Inicio > Tipo_de_afectacion
    Breadcrumbs::for('tipo_de_afectacion', function ($trail) {
      $trail->parent('home');
      $trail->push('Tipos de Afectaciones', route('tipo_de_afectacion'));
  });

  // GESTION DE PADRONES

  // Inicio > gestion > padron > mejoras
  Breadcrumbs::for('mejoras', function ($trail) {
      $trail->parent('home');
      $trail->push('GESTION');
      $trail->push('Padron');
      $trail->push('Mejoras de Parcela', route('mejoras'));
  });
  // Inicio > gestion > padron > documentos
  Breadcrumbs::for('documentos', function ($trail) {
    $trail->parent('home');
    $trail->push('GESTION');
    $trail->push('Padron');
    $trail->push('Documentos de Parcela', route('documentos'));
});

    // Inicio > gestion > padron >
    Breadcrumbs::for('padrones', function ($trail) {
      $trail->parent('home');
      $trail->push('GESTION');
      $trail->push('Padrones', route('parcelas'));
  });

      // Inicio > gestion > padron > id
      Breadcrumbs::for('edicion_padron', function ($trail, $parcela) {
        $trail->parent('padrones');
        $trail->push('Padron N° '.$parcela->parcela_padron, route('edicion_padron', $parcela->parcela_id));
    });

  // GESTION DE PERSONAS
      // Inicio > Personas
      Breadcrumbs::for('personas', function ($trail) {
        $trail->parent('home');
        $trail->push('GESTION');
        $trail->push('Módulo de Personas', route('modulo_personas'));
    });


  // GESTION DE UNION
      // Inicio > Personas
      Breadcrumbs::for('union', function ($trail) {
        $trail->parent('home');
        $trail->push('GESTION');
        $trail->push('Módulo de Union', route('modulo_union'));
    });

  // GESTION DE DESGLOSE
      // Inicio > Personas
      Breadcrumbs::for('desglose', function ($trail) {
        $trail->parent('home');
        $trail->push('GESTION');
        $trail->push('Módulo de Desglose', route('modulo_desglose'));
    });

    // GESTION DE DIRECCIONES
    // Inicio > Direcciones
    Breadcrumbs::for('direccion', function ($trail) {
      $trail->parent('home');
      $trail->push('GESTION');
      $trail->push('Módulo de Direcciones');
  });

  // GESTION DE CODIGOS

   // Inicio > Códigos > tipo_de_bonificacion
   Breadcrumbs::for('tipo_de_bonificacion', function ($trail) {
    $trail->parent('home');
    $trail->push('Códigos');
    $trail->push('Gestion de Bonificaciones');
  });

  // Inicio > Códigos > tipo_de_estado
  Breadcrumbs::for('tipo_de_estado', function ($trail) {
    $trail->parent('home');
    $trail->push('Códigos');
    $trail->push('Gestion de Estados de Parcela');
  });

  // Inicio > Códigos > tipos_de_ryb
  Breadcrumbs::for('tipos_de_ryb', function ($trail) {
    $trail->parent('home');
    $trail->push('Códigos');
    $trail->push('Gestion de RyB de Parcela');
  });
  
    // Inicio > Códigos > tipos_de_destinos
    Breadcrumbs::for('tipos_de_destinos', function ($trail) {
      $trail->parent('home');
      $trail->push('Códigos');
      $trail->push('Gestion de Destinos de Parcela');
    });

     // Inicio > Códigos > tipos_de_zonas
     Breadcrumbs::for('tipos_de_zonas', function ($trail) {
      $trail->parent('home');
      $trail->push('Códigos');
      $trail->push('Gestion de Zonas de Parcela');
    });

  // Inicio > Códigos > tipo_de_uso
  Breadcrumbs::for('tipo_de_uso', function ($trail) {
    $trail->parent('home');
    $trail->push('Códigos');
    $trail->push('Gestion de Uso de Mejora');      
  });
  // Inicio > Códigos > tipo_de_construccion
  Breadcrumbs::for('tipo_de_construccion', function ($trail) {
    $trail->parent('home');
    $trail->push('Códigos');
    $trail->push('Gestion de Codigos de Mejora');      
  });

    // Inicio > Auditorias
    Breadcrumbs::for('auditorias', function ($trail) {
      $trail->parent('home');
      $trail->push('Auditorias');
    });

    // Inicio > Reporte Dinamico
    Breadcrumbs::for('reporte_dinamico', function ($trail) {
      $trail->parent('home');
      $trail->push('Reporte Dinámico');
    });

    // Inicio > Totales
    Breadcrumbs::for('totales', function ($trail) {
      $trail->parent('home');
      $trail->push('Valores Totales');
    });




// Inicio > Versiones
Breadcrumbs::for('versiones', function ($trail) {
    $trail->parent('home');
    $trail->push('Versiones', route('versiones'));
});

// Inicio > Versiones > [Version]
Breadcrumbs::for('versionado', function ($trail, $version) {
    $trail->parent('versiones');
    $trail->push($version->version, route('versiones.show', $version->id));
});


   // Inicio > Migracion Auditorias
   Breadcrumbs::for('auditoria_migracion', function ($trail) {
    $trail->parent('home');
    $trail->push('Migración de Auditorias');
  });