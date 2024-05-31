$(document).ready( function(){
    console.log("cliceado");
    $("#tabla_id").DataTable({

        "pageLength":3, //Numero de PAginacion
        lenghtMenu:[ //Opciones de como se va a mostrar el paginado o numero de registros por dato
            [3,10,25,50],
            [3,10,25,50]
        ],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
        }
    });
});