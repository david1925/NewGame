
(function(){
 angular.module("NewGameApp",["pascalprecht.translate",'angularUtils.directives.dirPagination', 'ngRoute']);


   angular.module("NewGameApp").config(['$translateProvider', function ($translateProvider) {
  $translateProvider.translations("en", {
    "SIGN": "Sign in",
    "FRIENDS" : "Friends",
    "Login" : "Login",
    "Logout" : "Logout",
    "USER INFO": "User Info",
    "PROFILE IMAGE": "Profile image",
    "FILL THE FORM": "Fill the form",
    "Store": "Store",
    "Shop": "Shop",
    "Community": "Community",
    "Contact": "Contact",
    "Languages": "Languages",
    "All": "All",
    "USER PROFILE": "USER PROFILE",
    "Username": "Username",
    "Country": "Country",
    "Province": "Province",
    "Language": "Language",
    "Featured Games": "Featured Games",
    "Latest Releases": "Latest Releases",
    "Forums": "Forums",
    "Your topic has been saved!": "Your topic has been saved!",
    "¡Error! There has been an error with the topic": "¡Error! There has been an error with the topic",
    "Add Topic": "Add Topic",
    "Error! There has been a problem with the petition or uer not found!": "Error! There has been a problem with the petition or uer not found!",
    "Check your email, a confirmation link has been sent": "Check your email, a confirmation link has been sent",
    "Congratulations, your email has been sent correctly, we will reply you as soon as possible": "Congratulations, your email has been sent correctly, we will reply you as soon as possible"
  });
 
  $translateProvider.translations("es", {
    "SIGN": "Registrarse",
    "FRIENDS" : "Amigos",
    "Login" : "Entrar",
    "Logout" : "Cierra sesión",
    "USER INFO": "Informacion de usuario",
    "PROFILE IMAGE": "Imagen de perfil",
    "FILL THE FORM": "Rellena el formulario",
    "Store": "Biblioteca",
    "Shop": "Tienda",
    "Community": "Comunidad",
    "Contact": "Contacto",
    "Languages": "Idiomas",
    "All": "Todos",
    "USER PROFILE": "PERFIL DE USUARIO",
    "Username": "Usuario",
    "Country": "País",
    "Province": "Província",
    "Language": "Idioma",
    "Featured Games": "Juegos destacados",
    "Latest Releases": "Últimos lanzamientos",
    "Forums": "Foros",
    "Your topic has been saved!": "¡Tu pregunta ha sido guardada!",
    "¡Error! There has been an error with the topic": "¡Error! Ha ocurrido un error con el mensaje",
    "Add Topic": "Añadir pregunta",
    "Error! There has been a problem with the petition or uer not found!": "Error! Ha habido algún problema con la solicitud o el usuario no existe",
    "Check your email, a confirmation link has been sent": "Revisa tu correo, se te ha enviado un link de confirmación",
    "Congratulations, your email has been sent correctly, we will reply you as soon as possible": "Felicidades, tu correo se ha enviado correctamente, te responderemos con la mayor brevedad posible"
  });
  
  $translateProvider.translations("ca", {
    "SIGN": "Registrar-se",
    "FRIENDS" : "Amics",
    "Login" : "Entrar",
    "Logout" : "Tanca sessió",
    "USER INFO": "Informacio d'usuari",
    "PROFILE IMAGE": "imatge de perfil",
    "FILL THE FORM": "Omple el formulari",
    "Store": "Biblioteca",
    "Shop": "Tenda",
    "Community": "Comunitat",
    "Contact": "Contacte",
    "Languages": "Idiomes",
    "All": "Tots",
    "USER PROFILE": "PERFIL D'USUARI",
    "Username": "Usuari",
    "Country": "País",
    "Province": "Província",
    "Language": "Idioma",
    "Featured Games": "Jocs destacats",
    "Latest Releases": "Últims llançaments",
    "Forums": "Fòrums",
    "Your topic has been saved!": "¡La teva pregunta ha sigut desada!",
    "¡Error! There has been an error with the topic": "¡Error! Ha hagut un error amb el missatge",
    "Add Topic": "Afegir pregunta",
    "Error! There has been a problem with the petition or uer not found!": "Error! Hi ha hagut algún problema amb la sol·licitud o l'usuari no existeix",
    "Check your email, a confirmation link has been sent": "Revisa el teu correu, se t'ha enviat un correu de confirmació",
    "Congratulations, your email has been sent correctly, we will reply you as soon as possible": "Felicitats, el teu correu s'ha enviat correctament, et respondrem amb la major brevetat possible"
  });
 

    $translateProvider.preferredLanguage(localStorage.getItem("language"));
    $translateProvider.useSanitizeValueStrategy("escapeParameters"); 
}]);

    angular.module("NewGameApp").factory('Domain', function(){
        return "http://www.newgame.local/";
    })

    angular.module("NewGameApp").service('shoppingCart', function(){
    	var products = new Array();
        return {
            getProperty: function () {
            	products = localStorage.getItem("shoppingCart");
                return products;
            },
            setProperty: function(value) {
            	products = JSON.parse(localStorage.getItem("shoppingCart"));
            	if(products==null)products=new Array();            	
                products.push(value);                
                localStorage.setItem("shoppingCart", JSON.stringify(products));
                console.log("Valor del localStorage después de hacer el setItem" + localStorage.getItem("shoppingCart"));
            }
        };
    })

angular.module("NewGameApp").config(['$qProvider', function ($qProvider) {
    $qProvider.errorOnUnhandledRejections(false);
}]);

})();