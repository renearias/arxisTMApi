# language: es
# Source: http://github.com/aslakhellesoy/cucumber/blob/master/examples/i18n/es/features/adicion.feature
# Updated: Tue May 25 15:51:46 +0200 2010
Característica: Manejar Users data via the RESTful API
                Con el fin de ofrecer el recurso del usuario a través de una API hipermedia
                Como desarrollador de software de cliente
                Tengo que ser capaz de recuperar y actualizar JSON codificado recursos de los usuarios


    Antecedentes:
        Dado estos Usuarios con los siguientes detalles:
            | id | username | email              | password |
            | 1  | arxis    | renearias@arxis.la | arxisla  |
            | 2  | john     | john@test.org      | johnpass |
        Y me logueare con el siguiente username: "arxis", y contraseña: "arxisla"
        Y cuando consuma el punto final yo usare "Content-Type" de "application/json"
        Y cuando consuma el punto final yo usare "Accept" de "application/json"
        Y cuando consuma el punto final yo usare "User-Agent" de "Mozilla/4.0"
    Escenario: User cannot GET a Collection of User objects
        Cuando Yo envio una solicitud "GET" a "/usuarios"
        Entonces el codigo de respuesta debe de ser 405     
    Escenario: User can GET their personal data by their unique ID
        Cuando Yo envio una solicitud "GET" a "/usuarios/1"
        Entonces el codigo de respuesta debe de ser 200
        Y la cabecera de respuesta "Content-Type" debe ser igual a "application/json; charset=UTF-8"
        Y la respuesta debe contener un json:
        """
        {
            "id":1,
             "username":"arxis",
             "email":"renearias@arxis.la",
             "picture":"uploads\/documents\/images\/profile\/male.png",
             "name":""
        }
        """    
     #Escenario: Usuario no puede OBTENER una diferente User's personal data
     #   Cuando Yo envio una solicitud "GET" a "/usuarios/2"
     #   Entonces el codigo de respuesta debe de ser 403

    #Escenario: Usuario no puede determinar si otro usuario esta activo
     #   Cuando Yo envio una solicitud "GET" a "/usuarios/100"
     #   Entonces el codigo de respuesta debe de ser 403