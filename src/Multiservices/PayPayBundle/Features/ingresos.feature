# language: es
# Source: http://github.com/aslakhellesoy/cucumber/blob/master/examples/i18n/es/features/adicion.feature
# Updated: Tue May 25 15:51:46 +0200 2010
Característica: Manejar Ingresos data via the RESTful API
                Con el fin de ofrecer el recurso del usuario a través de una API hipermedia
                Como desarrollador de software de cliente
                Tengo que ser capaz de recuperar y actualizar JSON codificado recursos de los ingresos


    Antecedentes:
        Dado estos Usuarios con los siguientes detalles:
            | id | username | email              | password |
            | 1  | arxis    | renearias@arxis.la | arxisla  |
            | 2  | john     | john@test.org      | johnpass |
        Y estas formas de pago con los siguientes detalles:
            | id | formapago | descripcion                  |
            | 1 | EFECTIVO   | Pago al instante en Efectivo |
            | 2 | BANCO      | Pago por deposito bancario   |
        Y estos tipos de personas con los siguientes detalles:
           | id | codigo | nombre   |
           | 1  | NA    | NATURAL  |
           | 2  | JU    | JURIDICA |
        Y estos tipos de identificacion con los siguientes detalles:
           | id | codigo | nombre   | codigocompraats | codigoventaats |
           | 1  | CE    | CEDULA    | CE              | CE             |
           | 2  | PA    | PASAPORTE | PA              | CE             |
        Y estos contactos con los siguientes detalles:
           | id | paisid | codigo | identificacion | nombre            | direccion | nombrecomercial | telefonos | ciudad | fax | pais | contacto | registroempresarial | email        | actividadeconomica | clasecontribuyente | notas | cliente | proveedor | vendedor | empleado | transportista | recaudador | tipoidentificacion | tipopersona |
           | 1  | 1      | 1      | 1204135709     | Joselo Rodriguez  | direccion | nombrecomercial | 5555555   | Baba   | 00  | EC   | MARIA    | XXXX                | mail@mail.com|  ninguna           | Especial           | 11    | 1       |   0       | 0        | 0        |0              |    0       | 1                  | 1           |               
        Y estos ingresos con los siguientes detalles:
            | id | cliente | descripcion     | monto  | referencia | formapago |
            | 1  | 1       | descripcion1    | 50.23  | arxisla    | 1         |
            | 2  | 1       | descripcion2    | 24.58  | johnpass   | 1         |
            | 3  | 1       | descripcion3    | 210    | johnpass   | 1         |
        Y me logueare con el siguiente username: "arxis", y contraseña: "arxisla"
        Y cuando consuma el punto final yo usare "Content-Type" de "application/json"
        Y cuando consuma el punto final yo usare "Accept" de "application/json"
        Y cuando consuma el punto final yo usare "User-Agent" de "Mozilla/4.0"
        
        
    @ingreso
    Escenario: Usuario OBTIENE una Collection de Ingresos objects
        Cuando Yo envio una solicitud "GET" a "/api/ingresos"
        Entonces el codigo de respuesta debe de ser 200
    #Escenario: User can GET their personal data by their unique ID
    #    Cuando Yo envio una solicitud "GET" a "/ingresos/1"
    #    Entonces el codigo de respuesta debe de ser 200
    #    Y la cabecera de respuesta "Content-Type" debe ser igual a "application/json; charset=UTF-8"
    #    Y la respuesta debe contener un json:
    #    """
    #    {
    #        "id":1,
    #         "username":"arxis",
    #         "email":"renearias@arxis.la",
    #         "picture":"uploads\/documents\/images\/profile\/male.png",
    #         "name":""
    #    }
    #    """    
     