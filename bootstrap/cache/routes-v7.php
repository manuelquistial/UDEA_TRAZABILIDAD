<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/api/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HiYsb3clSU6nP6T6',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/usuarios/perfil' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_usuario',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/usuarios/update/perfil' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update_usuario_perfil',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tipostransaccion/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::D4B2mWbovCAMXfrz',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proyectos/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::U3YuWrjo0O3AFGUc',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transacciones/usuario' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'consulta_usuario',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/presolicitud' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'presolicitud',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::U60Pfm7grRGXyj39',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/presolicitud/save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'save_presolicitud',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/presolicitud/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update_presolicitud',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transacciones/correos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'correos',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/usuarios' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'usuarios',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/usuarios/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PuXgneQ3wpQ14Bfm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/usuarios/estado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QqI0wLyHVdYMDT2T',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/usuarios/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update_usuario',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/usuarios/paginacion' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ifzt9Q7H3jbiP2Yg',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tipostransaccion' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'tipos_transaccion',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mgLN1r00lZVs4Etw',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tipostransaccion/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::X1RW1SqQTiidMoGZ',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tipostransaccion/estado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::g8kpBSClXTztdB9c',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tipostransaccion/paginacion' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TD8F052PmDn5Aisk',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/centrocostos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'centro_costos',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::K3CPPGpajVgtRLte',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/centrocostos/paginacion' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9aQrLMJYOLxDCsLg',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/centrocostos/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::iGsRXcrugczYMsdN',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/centrocostos/estado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mPudf90NNwVKadbV',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/documentos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'documentos',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/documentos/save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'subir_documentos',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/presolicitud/estado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::36i5frtFQ5wMssHQ',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/presolicitud/redirect' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NMGLWoH1Owmg0Z5C',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/solicitud' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TS1FCFrOFVP6MozV',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/solicitud/estado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::D6420X84K1pp1EGK',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/solicitud/save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'save_solicitud',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/solicitud/rubros' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ngHhQSfEAoYl5N7H',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/solicitud/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update_solicitud',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tramite' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Q2q1aTKTdxtLHSSf',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tramite/estado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Vy8e5kpUS7PaeHWW',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tramite/save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'save_tramite',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tramite/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update_tramite',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/autorizado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rVNjqOSPvF0L0XBm',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/autorizado/estado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OD53vachPcFBRrOJ',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/autorizado/save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'save_autorizado',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/autorizado/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update_autorizado',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/preaprobado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PR9wPzRXwQp4vGp2',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/preaprobado/estado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Spy2uGWemddlVaSd',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/preaprobado/save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'save_preaprobado',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/preaprobado/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update_preaprobado',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/aprobado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PplPxwsqpCwrzeV5',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/aprobado/estado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ANTgC2WhPQsa2mTS',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/aprobado/save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'save_aprobado',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/aprobado/elements' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::barRXVMVTlvzUD9Y',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/aprobado/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update_aprobado',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reserva' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qIvilQhI957VQD6w',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reserva/estado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3OhutTHVQ9wyG3yC',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reserva/save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'save_reserva',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reserva/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update_reserva',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pago' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vhShCpfcdijVlQBd',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pago/estado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mXNWHDpitTHsI7lq',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pago/save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'save_pago',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pago/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update_pago',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/legalizado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ObN0NsczFT2nh8DJ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/legalizado/estado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SCOqryb4kNv0cORU',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/legalizado/save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'save_legalizado',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/legalizado/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update_legalizado',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/etapas' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'etapas',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transacciones/gestores' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'consulta_gestores',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/documentos/download' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'descargar_documentos',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/documentos/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'borrar_documento',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/usuario' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'usuario',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fYXKHz3snNoK49Hz',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HoRiYOYBMCKQ9YRp',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/forgot-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.request',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'password.email',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reset-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/verify-email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verification.notice',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/email/verification-notification' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verification.send',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/confirm-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aBb6RGot2iyCxsJY',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/p(?|re(?|solicitud/(?|edit/([^/]++)(*:43)|show/([^/]++)(*:63)|proyecto/([^/]++)(*:87))|aprobado/(?|index/([^/]++)(*:121)|show/([^/]++)(*:142)|edit/([^/]++)(*:163)))|ago/(?|index/([^/]++)(*:194)|show/([^/]++)(*:215)|edit/([^/]++)(*:236)))|/usuarios/(?|edit/([^/]++)(*:272)|search/([^/]++)(*:295))|/t(?|ipostransaccion/search/([^/]++)(*:340)|ra(?|mite/(?|index/([^/]++)(*:375)|show/([^/]++)(*:396)|edit/([^/]++)(*:417))|nsacciones/gestores/show/([^/]++)(*:459)))|/centrocostos/search/([^/]++)(*:498)|/solicitud/(?|index/([^/]++)(*:534)|show/([^/]++)(*:555)|edit/([^/]++)(*:576))|/a(?|utorizado/(?|index/([^/]++)(*:617)|show/([^/]++)(*:638)|edit/([^/]++)(*:659))|probado/(?|index/([^/]++)(*:693)|show/([^/]++)(*:714)|edit/([^/]++)(*:735)))|/rese(?|rva/(?|index/([^/]++)(*:774)|show/([^/]++)(*:795)|edit/([^/]++)(*:816))|t\\-password/([^/]++)(*:845))|/legalizado/(?|index/([^/]++)(*:883)|show/([^/]++)(*:904)|edit/([^/]++)(*:925))|/verify\\-email/([^/]++)/([^/]++)(*:966))/?$}sDu',
    ),
    3 => 
    array (
      43 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'edit_presolicitud',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      63 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_presolicitud',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      87 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::oDzGJjYQKQOYygSD',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      121 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'preaprobado',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      142 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_preaprobado',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      163 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'edit_preaprobado',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      194 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pago',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      215 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_pago',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      236 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'edit_pago',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      272 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'edit_usuario',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      295 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KotCOReKKA2wedYZ',
          ),
          1 => 
          array (
            0 => 'data',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      340 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VyKDf3gYm3RfXwzQ',
          ),
          1 => 
          array (
            0 => 'data',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      375 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'tramite',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      396 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_tramite',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      417 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'edit_tramite',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      459 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_gestores',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      498 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tf8XIL1y1Eb7EKme',
          ),
          1 => 
          array (
            0 => 'data',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      534 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'solicitud',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      555 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_solicitud',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      576 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'edit_solicitud',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      617 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'autorizado',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      638 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_autorizado',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      659 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'edit_autorizado',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      693 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'aprobado',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      714 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_aprobado',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      735 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'edit_aprobado',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      774 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reserva',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      795 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_reserva',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      816 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'edit_reserva',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      845 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.reset',
          ),
          1 => 
          array (
            0 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      883 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'legalizado',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      904 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show_legalizado',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      925 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'edit_legalizado',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      966 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verification.verify',
          ),
          1 => 
          array (
            0 => 'id',
            1 => 'hash',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'generated::HiYsb3clSU6nP6T6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'C:32:"Opis\\Closure\\SerializableClosure":289:{@klkS04SxsObkKMCu/72DxC8ZX8NwF2RglEucZSJKfcE=.a:5:{s:3:"use";a:0:{}s:8:"function";s:77:"function (\\Illuminate\\Http\\Request $request) {
    return $request->user();
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000032679f2a0000000079bbe1c1";}}',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::HiYsb3clSU6nP6T6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'show_usuario' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'usuarios/perfil',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\UsuarioController@show',
        'controller' => 'App\\Http\\Controllers\\UsuarioController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'show_usuario',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'update_usuario_perfil' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'usuarios/update/perfil',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\UsuarioController@updatePerfil',
        'controller' => 'App\\Http\\Controllers\\UsuarioController@updatePerfil',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'update_usuario_perfil',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::D4B2mWbovCAMXfrz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tipostransaccion/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\TipoTransaccionController@showAll',
        'controller' => 'App\\Http\\Controllers\\TipoTransaccionController@showAll',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::D4B2mWbovCAMXfrz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::U3YuWrjo0O3AFGUc' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proyectos/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PresolicitudController@showProyectos',
        'controller' => 'App\\Http\\Controllers\\PresolicitudController@showProyectos',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::U3YuWrjo0O3AFGUc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'consulta_usuario' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transacciones/usuario',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\TransaccionesController@showConsultaUsuario',
        'controller' => 'App\\Http\\Controllers\\TransaccionesController@showConsultaUsuario',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'consulta_usuario',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'presolicitud' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'presolicitud',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PresolicitudController@index',
        'controller' => 'App\\Http\\Controllers\\PresolicitudController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'presolicitud',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'save_presolicitud' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'presolicitud/save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PresolicitudController@store',
        'controller' => 'App\\Http\\Controllers\\PresolicitudController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'save_presolicitud',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'edit_presolicitud' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'presolicitud/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PresolicitudController@edit',
        'controller' => 'App\\Http\\Controllers\\PresolicitudController@edit',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'edit_presolicitud',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'update_presolicitud' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'presolicitud/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PresolicitudController@update',
        'controller' => 'App\\Http\\Controllers\\PresolicitudController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'update_presolicitud',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'correos' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transacciones/correos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\CorreosController@index',
        'controller' => 'App\\Http\\Controllers\\CorreosController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'correos',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'usuarios' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'usuarios',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\UsuarioController@index',
        'controller' => 'App\\Http\\Controllers\\UsuarioController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'usuarios',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::PuXgneQ3wpQ14Bfm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'usuarios/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\UsuarioController@showAll',
        'controller' => 'App\\Http\\Controllers\\UsuarioController@showAll',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::PuXgneQ3wpQ14Bfm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::QqI0wLyHVdYMDT2T' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'usuarios/estado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\UsuarioController@updateEstado',
        'controller' => 'App\\Http\\Controllers\\UsuarioController@updateEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::QqI0wLyHVdYMDT2T',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'edit_usuario' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'usuarios/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\UsuarioController@edit',
        'controller' => 'App\\Http\\Controllers\\UsuarioController@edit',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'edit_usuario',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'update_usuario' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'usuarios/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\UsuarioController@update',
        'controller' => 'App\\Http\\Controllers\\UsuarioController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'update_usuario',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::KotCOReKKA2wedYZ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'usuarios/search/{data}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\UsuarioController@showItem',
        'controller' => 'App\\Http\\Controllers\\UsuarioController@showItem',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::KotCOReKKA2wedYZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ifzt9Q7H3jbiP2Yg' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'usuarios/paginacion',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\UsuarioController@pagination',
        'controller' => 'App\\Http\\Controllers\\UsuarioController@pagination',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::ifzt9Q7H3jbiP2Yg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'tipos_transaccion' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tipostransaccion',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\TipoTransaccionController@index',
        'controller' => 'App\\Http\\Controllers\\TipoTransaccionController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'tipos_transaccion',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::mgLN1r00lZVs4Etw' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'tipostransaccion',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\TipoTransaccionController@store',
        'controller' => 'App\\Http\\Controllers\\TipoTransaccionController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::mgLN1r00lZVs4Etw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::X1RW1SqQTiidMoGZ' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'tipostransaccion/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\TipoTransaccionController@update',
        'controller' => 'App\\Http\\Controllers\\TipoTransaccionController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::X1RW1SqQTiidMoGZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::g8kpBSClXTztdB9c' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'tipostransaccion/estado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\TipoTransaccionController@updatEestado',
        'controller' => 'App\\Http\\Controllers\\TipoTransaccionController@updatEestado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::g8kpBSClXTztdB9c',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::VyKDf3gYm3RfXwzQ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tipostransaccion/search/{data}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\TipoTransaccionController@show',
        'controller' => 'App\\Http\\Controllers\\TipoTransaccionController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::VyKDf3gYm3RfXwzQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::TD8F052PmDn5Aisk' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tipostransaccion/paginacion',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\TipoTransaccionController@pagination',
        'controller' => 'App\\Http\\Controllers\\TipoTransaccionController@pagination',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::TD8F052PmDn5Aisk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'centro_costos' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'centrocostos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\CentroCostosController@index',
        'controller' => 'App\\Http\\Controllers\\CentroCostosController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'centro_costos',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::tf8XIL1y1Eb7EKme' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'centrocostos/search/{data}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\CentroCostosController@show',
        'controller' => 'App\\Http\\Controllers\\CentroCostosController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::tf8XIL1y1Eb7EKme',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::9aQrLMJYOLxDCsLg' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'centrocostos/paginacion',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\CentroCostosController@pagination',
        'controller' => 'App\\Http\\Controllers\\CentroCostosController@pagination',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::9aQrLMJYOLxDCsLg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::K3CPPGpajVgtRLte' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'centrocostos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\CentroCostosController@store',
        'controller' => 'App\\Http\\Controllers\\CentroCostosController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::K3CPPGpajVgtRLte',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::iGsRXcrugczYMsdN' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'centrocostos/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\CentroCostosController@update',
        'controller' => 'App\\Http\\Controllers\\CentroCostosController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::iGsRXcrugczYMsdN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::mPudf90NNwVKadbV' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'centrocostos/estado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\CentroCostosController@updateEstado',
        'controller' => 'App\\Http\\Controllers\\CentroCostosController@updateEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::mPudf90NNwVKadbV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'documentos' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'documentos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentosController@index',
        'controller' => 'App\\Http\\Controllers\\DocumentosController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'documentos',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'subir_documentos' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'documentos/save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:Administrador',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentosController@store',
        'controller' => 'App\\Http\\Controllers\\DocumentosController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'subir_documentos',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::U60Pfm7grRGXyj39' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'presolicitud',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PresolicitudController@getEstado',
        'controller' => 'App\\Http\\Controllers\\PresolicitudController@getEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::U60Pfm7grRGXyj39',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::36i5frtFQ5wMssHQ' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'presolicitud/estado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PresolicitudController@setEstado',
        'controller' => 'App\\Http\\Controllers\\PresolicitudController@setEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::36i5frtFQ5wMssHQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'show_presolicitud' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'presolicitud/show/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PresolicitudController@show',
        'controller' => 'App\\Http\\Controllers\\PresolicitudController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'show_presolicitud',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::NMGLWoH1Owmg0Z5C' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'presolicitud/redirect',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PresolicitudController@redirect',
        'controller' => 'App\\Http\\Controllers\\PresolicitudController@redirect',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::NMGLWoH1Owmg0Z5C',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::oDzGJjYQKQOYygSD' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'presolicitud/proyecto/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PresolicitudController@financieroProyecto',
        'controller' => 'App\\Http\\Controllers\\PresolicitudController@financieroProyecto',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::oDzGJjYQKQOYygSD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::TS1FCFrOFVP6MozV' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'solicitud',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\SolicitudController@getEstado',
        'controller' => 'App\\Http\\Controllers\\SolicitudController@getEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::TS1FCFrOFVP6MozV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::D6420X84K1pp1EGK' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'solicitud/estado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\SolicitudController@setEstado',
        'controller' => 'App\\Http\\Controllers\\SolicitudController@setEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::D6420X84K1pp1EGK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'solicitud' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'solicitud/index/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\SolicitudController@index',
        'controller' => 'App\\Http\\Controllers\\SolicitudController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'solicitud',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'save_solicitud' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'solicitud/save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\SolicitudController@store',
        'controller' => 'App\\Http\\Controllers\\SolicitudController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'save_solicitud',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'show_solicitud' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'solicitud/show/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\SolicitudController@show',
        'controller' => 'App\\Http\\Controllers\\SolicitudController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'show_solicitud',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'edit_solicitud' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'solicitud/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\SolicitudController@edit',
        'controller' => 'App\\Http\\Controllers\\SolicitudController@edit',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'edit_solicitud',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ngHhQSfEAoYl5N7H' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'solicitud/rubros',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\SolicitudController@getRubros',
        'controller' => 'App\\Http\\Controllers\\SolicitudController@getRubros',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::ngHhQSfEAoYl5N7H',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'update_solicitud' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'solicitud/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\SolicitudController@update',
        'controller' => 'App\\Http\\Controllers\\SolicitudController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'update_solicitud',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Q2q1aTKTdxtLHSSf' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'tramite',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\TramiteController@getEstado',
        'controller' => 'App\\Http\\Controllers\\TramiteController@getEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::Q2q1aTKTdxtLHSSf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Vy8e5kpUS7PaeHWW' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'tramite/estado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\TramiteController@setEstado',
        'controller' => 'App\\Http\\Controllers\\TramiteController@setEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::Vy8e5kpUS7PaeHWW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'tramite' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tramite/index/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\TramiteController@index',
        'controller' => 'App\\Http\\Controllers\\TramiteController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'tramite',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'save_tramite' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'tramite/save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\TramiteController@store',
        'controller' => 'App\\Http\\Controllers\\TramiteController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'save_tramite',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'show_tramite' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tramite/show/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\TramiteController@show',
        'controller' => 'App\\Http\\Controllers\\TramiteController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'show_tramite',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'edit_tramite' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tramite/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\TramiteController@edit',
        'controller' => 'App\\Http\\Controllers\\TramiteController@edit',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'edit_tramite',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'update_tramite' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'tramite/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\TramiteController@update',
        'controller' => 'App\\Http\\Controllers\\TramiteController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'update_tramite',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::rVNjqOSPvF0L0XBm' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'autorizado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\AutorizadoController@getEstado',
        'controller' => 'App\\Http\\Controllers\\AutorizadoController@getEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::rVNjqOSPvF0L0XBm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::OD53vachPcFBRrOJ' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'autorizado/estado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\AutorizadoController@setEstado',
        'controller' => 'App\\Http\\Controllers\\AutorizadoController@setEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::OD53vachPcFBRrOJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'autorizado' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'autorizado/index/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\AutorizadoController@index',
        'controller' => 'App\\Http\\Controllers\\AutorizadoController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'autorizado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'save_autorizado' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'autorizado/save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\AutorizadoController@store',
        'controller' => 'App\\Http\\Controllers\\AutorizadoController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'save_autorizado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'show_autorizado' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'autorizado/show/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\AutorizadoController@show',
        'controller' => 'App\\Http\\Controllers\\AutorizadoController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'show_autorizado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'edit_autorizado' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'autorizado/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\AutorizadoController@edit',
        'controller' => 'App\\Http\\Controllers\\AutorizadoController@edit',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'edit_autorizado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'update_autorizado' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'autorizado/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\AutorizadoController@update',
        'controller' => 'App\\Http\\Controllers\\AutorizadoController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'update_autorizado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::PR9wPzRXwQp4vGp2' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'preaprobado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PreaprobadoController@getEstado',
        'controller' => 'App\\Http\\Controllers\\PreaprobadoController@getEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::PR9wPzRXwQp4vGp2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Spy2uGWemddlVaSd' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'preaprobado/estado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PreaprobadoController@setEstado',
        'controller' => 'App\\Http\\Controllers\\PreaprobadoController@setEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::Spy2uGWemddlVaSd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'preaprobado' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'preaprobado/index/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PreaprobadoController@index',
        'controller' => 'App\\Http\\Controllers\\PreaprobadoController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'preaprobado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'save_preaprobado' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'preaprobado/save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PreaprobadoController@store',
        'controller' => 'App\\Http\\Controllers\\PreaprobadoController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'save_preaprobado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'show_preaprobado' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'preaprobado/show/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PreaprobadoController@show',
        'controller' => 'App\\Http\\Controllers\\PreaprobadoController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'show_preaprobado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'edit_preaprobado' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'preaprobado/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PreaprobadoController@edit',
        'controller' => 'App\\Http\\Controllers\\PreaprobadoController@edit',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'edit_preaprobado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'update_preaprobado' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'preaprobado/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PreaprobadoController@update',
        'controller' => 'App\\Http\\Controllers\\PreaprobadoController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'update_preaprobado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::PplPxwsqpCwrzeV5' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'aprobado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\AprobadoController@getEstado',
        'controller' => 'App\\Http\\Controllers\\AprobadoController@getEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::PplPxwsqpCwrzeV5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ANTgC2WhPQsa2mTS' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'aprobado/estado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\AprobadoController@setEstado',
        'controller' => 'App\\Http\\Controllers\\AprobadoController@setEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::ANTgC2WhPQsa2mTS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'aprobado' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'aprobado/index/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\AprobadoController@index',
        'controller' => 'App\\Http\\Controllers\\AprobadoController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'aprobado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'save_aprobado' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'aprobado/save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\AprobadoController@store',
        'controller' => 'App\\Http\\Controllers\\AprobadoController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'save_aprobado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::barRXVMVTlvzUD9Y' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'aprobado/elements',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\AprobadoController@update_items',
        'controller' => 'App\\Http\\Controllers\\AprobadoController@update_items',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::barRXVMVTlvzUD9Y',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'show_aprobado' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'aprobado/show/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\AprobadoController@show',
        'controller' => 'App\\Http\\Controllers\\AprobadoController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'show_aprobado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'edit_aprobado' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'aprobado/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\AprobadoController@edit',
        'controller' => 'App\\Http\\Controllers\\AprobadoController@edit',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'edit_aprobado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'update_aprobado' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'aprobado/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\AprobadoController@update',
        'controller' => 'App\\Http\\Controllers\\AprobadoController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'update_aprobado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::qIvilQhI957VQD6w' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'reserva',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\ReservaController@getEstado',
        'controller' => 'App\\Http\\Controllers\\ReservaController@getEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::qIvilQhI957VQD6w',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::3OhutTHVQ9wyG3yC' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'reserva/estado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\ReservaController@setEstado',
        'controller' => 'App\\Http\\Controllers\\ReservaController@setEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::3OhutTHVQ9wyG3yC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'reserva' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reserva/index/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\ReservaController@index',
        'controller' => 'App\\Http\\Controllers\\ReservaController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'reserva',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'save_reserva' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'reserva/save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\ReservaController@store',
        'controller' => 'App\\Http\\Controllers\\ReservaController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'save_reserva',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'show_reserva' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reserva/show/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\ReservaController@show',
        'controller' => 'App\\Http\\Controllers\\ReservaController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'show_reserva',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'edit_reserva' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reserva/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\ReservaController@edit',
        'controller' => 'App\\Http\\Controllers\\ReservaController@edit',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'edit_reserva',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'update_reserva' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'reserva/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\ReservaController@update',
        'controller' => 'App\\Http\\Controllers\\ReservaController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'update_reserva',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::vhShCpfcdijVlQBd' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'pago',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PagoController@getEstado',
        'controller' => 'App\\Http\\Controllers\\PagoController@getEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::vhShCpfcdijVlQBd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::mXNWHDpitTHsI7lq' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'pago/estado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PagoController@setEstado',
        'controller' => 'App\\Http\\Controllers\\PagoController@setEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::mXNWHDpitTHsI7lq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'pago' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pago/index/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PagoController@index',
        'controller' => 'App\\Http\\Controllers\\PagoController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'pago',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'save_pago' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'pago/save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PagoController@store',
        'controller' => 'App\\Http\\Controllers\\PagoController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'save_pago',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'show_pago' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pago/show/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PagoController@show',
        'controller' => 'App\\Http\\Controllers\\PagoController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'show_pago',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'edit_pago' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pago/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PagoController@edit',
        'controller' => 'App\\Http\\Controllers\\PagoController@edit',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'edit_pago',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'update_pago' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'pago/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\PagoController@update',
        'controller' => 'App\\Http\\Controllers\\PagoController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'update_pago',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ObN0NsczFT2nh8DJ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'legalizado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\LegalizadoController@getEstado',
        'controller' => 'App\\Http\\Controllers\\LegalizadoController@getEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::ObN0NsczFT2nh8DJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::SCOqryb4kNv0cORU' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'legalizado/estado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\LegalizadoController@setEstado',
        'controller' => 'App\\Http\\Controllers\\LegalizadoController@setEstado',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::SCOqryb4kNv0cORU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'legalizado' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'legalizado/index/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\LegalizadoController@index',
        'controller' => 'App\\Http\\Controllers\\LegalizadoController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'legalizado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'save_legalizado' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'legalizado/save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\LegalizadoController@store',
        'controller' => 'App\\Http\\Controllers\\LegalizadoController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'save_legalizado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'show_legalizado' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'legalizado/show/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\LegalizadoController@show',
        'controller' => 'App\\Http\\Controllers\\LegalizadoController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'show_legalizado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'edit_legalizado' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'legalizado/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\LegalizadoController@edit',
        'controller' => 'App\\Http\\Controllers\\LegalizadoController@edit',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'edit_legalizado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'update_legalizado' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'legalizado/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\LegalizadoController@update',
        'controller' => 'App\\Http\\Controllers\\LegalizadoController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'update_legalizado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'etapas' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'etapas',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\MainController@etapas',
        'controller' => 'App\\Http\\Controllers\\MainController@etapas',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'etapas',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'consulta_gestores' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transacciones/gestores',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\TransaccionesController@showConsultaGestores',
        'controller' => 'App\\Http\\Controllers\\TransaccionesController@showConsultaGestores',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'consulta_gestores',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'show_gestores' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transacciones/gestores/show/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'tipo_transaccion',
        ),
        'uses' => 'App\\Http\\Controllers\\TransaccionesController@show',
        'controller' => 'App\\Http\\Controllers\\TransaccionesController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'show_gestores',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'descargar_documentos' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'documentos/download',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentosController@downloads',
        'controller' => 'App\\Http\\Controllers\\DocumentosController@downloads',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'descargar_documentos',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'borrar_documento' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'documentos/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentosController@delete',
        'controller' => 'App\\Http\\Controllers\\DocumentosController@delete',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'borrar_documento',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'usuario' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'usuario',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisteredUserController@create',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisteredUserController@create',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'usuario',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::fYXKHz3snNoK49Hz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'usuario',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisteredUserController@store',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisteredUserController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::fYXKHz3snNoK49Hz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController@create',
        'controller' => 'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController@create',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::HoRiYOYBMCKQ9YRp' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController@store',
        'controller' => 'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::HoRiYOYBMCKQ9YRp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.request' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'forgot-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\PasswordResetLinkController@create',
        'controller' => 'App\\Http\\Controllers\\Auth\\PasswordResetLinkController@create',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.request',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.email' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'forgot-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\PasswordResetLinkController@store',
        'controller' => 'App\\Http\\Controllers\\Auth\\PasswordResetLinkController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.email',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reset-password/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\NewPasswordController@create',
        'controller' => 'App\\Http\\Controllers\\Auth\\NewPasswordController@create',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.reset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'reset-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\NewPasswordController@store',
        'controller' => 'App\\Http\\Controllers\\Auth\\NewPasswordController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'verification.notice' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'verify-email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\EmailVerificationPromptController@__invoke',
        'controller' => 'App\\Http\\Controllers\\Auth\\EmailVerificationPromptController@__invoke',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'verification.notice',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'verification.verify' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'verify-email/{id}/{hash}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'signed',
          3 => 'throttle:6,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\VerifyEmailController@__invoke',
        'controller' => 'App\\Http\\Controllers\\Auth\\VerifyEmailController@__invoke',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'verification.verify',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'verification.send' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'email/verification-notification',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'throttle:6,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\EmailVerificationNotificationController@store',
        'controller' => 'App\\Http\\Controllers\\Auth\\EmailVerificationNotificationController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'verification.send',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.confirm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'confirm-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmablePasswordController@show',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmablePasswordController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.confirm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::aBb6RGot2iyCxsJY' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'confirm-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmablePasswordController@store',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmablePasswordController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::aBb6RGot2iyCxsJY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController@destroy',
        'controller' => 'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController@destroy',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
  ),
)
);
