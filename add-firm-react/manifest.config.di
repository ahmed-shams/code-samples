{
    "factories" : [
        {
            "path" : "../common/view/data-grid-page",
            "swap" : {
                "RequestStream": "AddFirmStream",
                "DataModel": "AddFirmModel"
            }
        }
    ],

    "types" : [
        {
            "path" : "../common/service/list-service",
            "id" : "AddFirmService",
            "swap" : {
                "InputStream": "AddFirmStream",
                "parser": "AddFirmParser",
                "URI": "GetFirmlistURI"
            }
        }, {
            "path" : "../common/service/item-service",
            "id" : "AddService",
            "swap" : {
                "InputStream": "AddStream",
                "parser": "AddFirmItemParser",
                "URI": "AddURI"
                }
        }, {
            "path" : "../common/service/item-service",
            "id" : "RemoveService",
            "swap" : {
                "InputStream": "RemoveStream",
                "parser": "AddFirmItemParser",
                "URI": "RemoveURI"
                }
        }, {
           "path" : "../common/service/item-service",
           "id" : "EditService",
           "swap" : {
               "InputStream": "EditStream",
               "parser": "AddFirmItemParser",
               "URI": "EditURI"
               }
        }, {
            "path" : "../common/service/item-service",
           "id" : "ReactivateService",
           "swap" : {
               "InputStream": "ReactivateStream",
               "parser": "AddFirmItemParser",
               "URI": "EditURI"
               }
        }, {
            "path" : "./add-firm-model"
        }, {
            "path": "./add-firm-view",
            "id": "AddFirmView",
            "using": [
                "AddStream",
                "Copy"
            ]
        },

        {
            "path" : "./config"
        }
    ],

    "data" : [
        {
            "path" : "./copy.json",
            "id" : "AddFirmCopy"
        }
    ]
}
