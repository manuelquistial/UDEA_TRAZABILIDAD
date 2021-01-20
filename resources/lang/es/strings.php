<?php

return [
    'cambio_estado' => [
        'titulo' => 'Seleccionar etapa por confirmar',
        'confirmar' => 'Confirmar',
        'declinar' => 'Declinar'
    ],
    'menu_superior' => [
        'titulo' => 'Solicitudes de trámites administrativos y financieros',
        'opciones' => [
            'perfil' => 'Perfil',
            'configuracion' => 'Configuración',
            'cerrar_sesion' => 'Cerrar sesión'
        ],
        'transaccion' => 'Consulta de Tramites',
        'consulta_usuario' => 'Consulta de Usuarios',
        'consulta_gestores' => 'Consulta de Gestores',
        'correos' => 'Correos',
        'presolicitud' => 'Presolicitud'
    ],
    'usuario' => [
        'nombre' => 'Nombre',
        'apellidos' => 'Apellidos',
        'email' => 'E-Mail',
        'cedula' => 'Cédula',
        'telefono' => 'Teléfono',
        'guardar' => 'Guardar',
        'etapas' => [
            'ninguno' => 'Ninguno'
        ]
    ],
    'correos' => [
        'codigo' => 'Codigo',
        'enviado' => 'Enviado',
        'tipo' => 'Tipo',
        'enviar_correos' => 'Enviar correos'
    ],
    'configuracion' => [
        'menu_lateral' => [
            ['centro_costos', 'Centros de Costos'],
            ['tipos_transaccion', 'Tipos de Transacción'],
            ['usuarios', 'Usuarios']
        ],
        'perfil' => 'Perfil',
        'tipos_transaccion' => 'Tipos de Transacción',
        'tipo_transaccion' => 'Tipo de Transacción',
        'escribir_transaccion' => 'Digite tipo de transacción',
        'nuevo_tipo_transaccion' => 'Nuevo tipo de transacción',
        'centro_costos' => 'Centro de Costos',
        'centro_costo' => 'Centro de Costo',
        'nuevo_centro_costo' => 'Nuevo centro de costo',
        'usuarios' => 'Usuarios',
        'buscar_usuario' => 'Buscar Usuario',
        'nuevo_usuario' => 'Nuevo usuario',
        'sap' => 'SAP',
        'sigep' => 'SIGEP',
        'habilitado' => 'Habilitado',
        'etapa' => 'Etapa',
        'modal' => [
            'tipos_transaccion' => [
                'titulo' => 'Tipo de Transacción',
                'placeholder' => 'Buscar tipo de transacción',
                'escribir_item' => 'Digite tipo de transacción a guardar',
                'deshabilitar' => "¿Deshabilitar los tipos de transacción seleccionados?"
            ],
            'centro_costos' => [
                'titulo' => 'Centro de Costos',
                'placeholder' => 'Buscar centro de costo',
                'escribir_item' => 'Digite centro de costo a guardar',
                'deshabilitar' => "¿Deshabilitar los centros de costos seleccionados?"
            ],
            'usuarios' => [
                'titulo' => 'Usuario',
                'placeholder' => 'Buscar usuario',
                'deshabilitar' => "¿Deshabilitar los usuarios seleccionados?"
            ]
        ]
    ],
    'notes' => [
        'codigo_sigep' => 'Consulte <span class="links" id="codigo_sigep" data-project=":project">aquí</span> el codigo sigep',
        'valor' => 'Consulte <span class="links">aquí</span> los recursos disponibles de su proyecto',
        'fecha' => 'Para Viáticos y Tiquetes es Obligatorio',
        'presolicitud' => 'Para tramites de solicitud de apoyos economicos<br> 1. Descargar <span class="links">aquí</span> Solicitud de Recursos <br> 2. Adjuntar carta de invitacion al evento',
        'solicitud' => 'Adjuntar Análisis de Conveniencia y/o Formato de Justificación CPSP',
        'autorizado' => 'Describir alguna novedad',
        'usuario_etapa' => 'Seleccionar sólo si es el funcionario encargado.',
        'usuario_tipo_transaccion' => 'Seleccionar los tipos de transaccion al cual el funcionario esta encargado.',
        'usuario_administrador' => 'Seleccionar en caso de que el funcionario sea Administrador de la plataforma',
        'otro_proyecto' => 'Digite su proyecto en caso de no encontrarlo anteriormente.',
        'descripcion_pendiente' => 'Justificar en caso de tener pendiente el codigo SIGEP',
        'empty_codigo_sigep' => 'Requiere justificacion.'
    ],
    'general' => [
        'valor' => 'Valor',
        'confirmar' => 'Confirmar',
        'crp' => 'No. del CRP o Pedido',
        'fechaSolicitud' => 'Fecha de Solicitud',
        'anexos' => 'Anexos',
        'encargado' => 'Encargado',
        'fecha' => 'Fecha',
        'tramite' => 'Tramites',
        'solicitud' => 'Solicitudes',
        'configuracion' => 'Configuración',
        'consecutivo' => 'Consecutivo',
        'guardar' => 'Guardar',
        'generada' => 'generada',
        'generado' => 'generado',
        'guardado' => 'guardado',
        'guardada' => 'guardada',
        'creado' => 'creada',
        'actualizar' => "Actualizar",
        'etapas' => 'Etapas',
        'presupuesto_inicial' => 'Presupuesto inicial',
        'egreso' => 'Egreso',
        'disponible' => 'Disponible',
        'estado' => 'Estado'
    ],
    'presolicitud' => [
        'proyecto' => 'Programa, proyecto y líneas misionales',
        'otro_proyecto' => 'Otro Proyecto',
        'tipo_transaccion' => 'Tipo de Transacción',
        'descripcion' => 'Descripción de Solicitud',
        'fecha_inicial' => 'Fecha Inicial',
        'fecha_final' => 'Fecha Final',
        'enviar' => 'Enviar',
        'tramitar' => 'Tramitar',
        'redireccionar' => 'Redireccionar'
    ],
    'solicitud' => [
        'centro_costos' => 'Centro de Costos',
        'numero_consecutivo' => 'No. Consecutivo',
        'fecha_conveniencia' => 'Fecha de Análisis de conveniencia - Formato de Justificación CPSF',
        'codigo_sigep' => 'Codigo SIGEP',
        'concepto' => 'Concepto',
        'rubro_egreso' => 'Rubro de egresos'
    ],
    'tramite' => [
        'consecutivo_sap' => 'Consecutivo transacción SAP y Portal',
        'fecha_sap' => 'Fecha de Solicitud SAP'
    ],
    'autorizado' => [
        'codigo_sigep' => 'Código registro SIGEP',
        'pendiente' => 'Pendiente',
        'confirmacionEnvio' => 'Confirmación de Envío al Ordenador del Gastos',  
        'fechaEnvio' => 'Fecha de Envío',
        'descripcion_pendiente' => 'Descripcion'
    ],
    'preaprobado' => [
        'cdp' => 'No. CDP',
        'fecha_cdp' => 'Fecha del CDP'
    ],
    'aprobado' => [
        'fecha_envio_documento' => 'Fecha de Elaboración Documento Legal (Orden de pedido, contrato, convenio, resolución)',
        'fecha_envio_decanatura' => 'Fecha de Envío - Decanatura',
        'fecha_envio_presupuestos' => 'Fecha de Envío - Presupuestos',
        'solpe' => 'Solpe',
        'fecha_crp_pedido' => 'Fecha del CRP o Pedido',
        'valor_final_crp' => 'Valor final del CRP',
        'nombre_tercero' => 'Nombre del Tercero',
        'identificacion_tercero' => 'No. De Identificación del tercero'
    ],
    'reserva' => [
        'saldo' => 'Saldo de la Reserva',
        'num_oficio' => 'No. de oficio de cancelación de la reserva o su remanente',
        'fecha_cancelacion' => 'Fecha de solicitud a presupuestos, la cancelación de la reserva o su remanente'
    ],
    'pago' => [
        'valor_egreso' => 'Valor del egreso'
    ],
    'legalizado' => [
        'crp' => 'No. de CRP o No. de comprobante',
        'valor' => 'Valor del egreso',
        'reintegro' => 'Reintegro'
    ],
    'etapas' => [
        'presolicitud' => 'Presolicitud',
        'solicitud' => 'Solicitud',
        'tramite' => 'Tramite',
        'autorizado' => 'Autorizado Ordenador',
        'preaprobado' => 'Preaprobado Presupuesto',
        'aprobado' => 'Aprobado Presupuesto',
        'reserva' => 'Reserva',
        'pago' => 'Pago',
        'legalizado' => 'Legalizado'
    ],
    'login' => [
        'iniciar_sesion' => 'Iniciar sesión',
        'usuario' => 'Usuario*',
        'password' => 'Contraseña*',
        'conectar' => 'Conectar',
        'olvido_password' => '¿Olvidaste tu contraseña?'
    ],
];