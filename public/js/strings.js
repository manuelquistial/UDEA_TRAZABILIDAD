var form = {
    "generalForm" : {
        "valor" : "Valor",
        "confirmar" : "Confirmar",
        "crp" : "No. del CRP o Pedido",
        "fechaSolicitud" : "Fecha de Solicitud",
        "anexos" : "Anexos",
        "encargado" : "Encargado",
        "fecha" : "Fecha",
        "tramite" : "Tramites",
        "solicitud" : "Solicitudes",
        "configuracion" : "Configuración",
        "consecutivo" : "Consecutivo",
        "fechaS": "Fecha de Solicitud",
        "fechaC": "Fecha de Confimación",
        "solicitante": "Solicitante"
    },
    "presolicitudForm" : {
        "proyecto" : "Nombre del Proyecto",
        "transaccion" : "Tipo de Transacción ",
        "descripcion" : "Descripción de Solicitud",
        "fechaI" : "Fecha Inicial",
        "fechaF" : "Fecha Final"
    },
    "solicitudForm" : {
        "centroCostos" : "Centro de Costos",
        "numConsecutivo" : "No. Consecutivo",
        "fechaConveniencia" : "Fecha de Análisis de conveniencia - Formato de Justificación CPSF",
        "pplMisionales" : "Programa, proyecto, líneas misionales",
        "codigoSigep" : "Codigo SIGEP",
        "responsable" : "Nombres y Apellidos",
        "telExt" : "Teléfono o Extensión"
    },
    "tramiteForm" : {
        "consecutivoSap" : "Consecutivo Transacción SAP y Portal",
        "fechaSap" : "Fecha de Solicitud SAP"
    },
    "autorizadoForm" : {
        "codigoRegistroSigep" : "Código registro SIGEP",
        "pendiente" : "Pendiente",
        "confirmacionEnvio" : "Confirmación de Envío al Ordenador del Gastos",  
        "fechaEnvio" : "Fecha de Envío",
        "descripcion" : "Observaciones"
    },
    "preaprobadoForm" : {
        "cdp" : "No. CDP",
        "fechaCDP" : "Fecha del CDP"
    },
    "aprobadoForm" : {
        "fechaDoc" : "Fecha de Elaboración Documento Legal (Orden de pedido, contrato, convenio, resolución)",
        "fechaDec" : "Fecha de Envío - Decanatura",
        "fechaPre" : "Fecha de Envío - Presupuestos",
        "solpe" : "Solpe",
        "fechaCrp" : "Fecha del CRP",
        "valorFinal" : "Valor Final del CRP",
        "nombreTercero" : "Nombre del Tercero",
        "ccTercero" : "No. De Identificación del tercero"
    },
    "reservaForm" : {
        "saldo" : "Saldo de la Reserva",
        "numOficio" : "No. de oficio de cancelación de la reserva o su remanente",
        "fechaCancelacion" : "Fecha de solicitud a presupuestos la cancelación de la reserva o su remanente"
    },
    "pagoForm" : {
        "valor" : "Valor del Egreso"
    },
    "legalizadoForm" : {
        "crp" : "No. de CRP o No. de Comprobante",
        "valor" : "Valor del Egreso",
        "reintegro" : "Reintegro"
    }
}

var configuracion = {
    "detalles":{
        "agregar": "Agregar",
        "actualizar": "Actualizar",
        "eliminar": "Eliminar"
    },
    "href":{
        "agregar": "agregar",
        "actualizar": "actualizar",
        "eliminar": "eliminar"
    }
}

var etapas = {
    "presolicitud": "Presolicitud",
    "solicitud": "Solicitud",
    "tramite": "Tramite",
    "autorizado": "Autorizado Ordenador",
    "preaprobado": "Preaprobado Presupuesto",
    "aprobado": "Aprobado Presupuesto",
    "reserva": "Reserva",
    "pago": "Pago",
    "legalizado": "Legalizado"
}

export{form, etapas, configuracion}