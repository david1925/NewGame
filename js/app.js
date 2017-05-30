
(function(){
 angular.module("NewGameApp",["pascalprecht.translate",'angularUtils.directives.dirPagination', 'ngRoute']);


   angular.module("NewGameApp").config(['$translateProvider', function ($translateProvider) {
  $translateProvider.translations("en", {
    "Genres filter": "Genres filter",
    "Price filter": "Price filter",
    "Post your review": "Post your review",
    "Valorations": "Valorations",
    "Video card": "Video card",
    "Hard disk": "Hard disk",
    "Memory": "Memory",
    "Processor": "Processor",
    "Operative system": "Operative system",
    "Minimum": "Minimum",
    "Recommended": "Recommended",
    "Game requirements": "Game requirements",
    "Requirements": "Requirements",
    "SIGN": "Sign in",
    "FRIENDS" : "Friends",
    "Login" : "Login",
    "Logout" : "Logout",
    "USER INFO": "User Info",
    "PROFILE IMAGE": "Profile image",
    "FILL THE FORM": "Fill the form",
    "Store": "Store",
    "SHOP": "Shop",
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
    "Your shopping cart it's empty": "Your shopping cart it's empty"
  });
 
  $translateProvider.translations("es", {
    "Genres filter": "Filtro por género",
    "Price filter": "Filtro por precio",
    "Post your review": "Publica tu análisis",
    "Valorations": "Valoraciones",
    "Video card": "Tarjeta de video",
    "Hard disk": "Disco duro",
    "Memory": "Memoria",
    "Processor": "Procesador",
    "Operative system": "Sistema operativo",
    "Minimum": "Mínimo",
    "Recommended": "Recomendado",
    "Game requirements": "Requisitos del juego",
    "Requirements": "Requisitos",
    "Owned games": "Tus juegos",
    "SIGN": "Registrarse",
    "FRIENDS" : "Amigos",
    "Login" : "Entrar",
    "Logout" : "Cierra sesión",
    "USER INFO": "Informacion de usuario",
    "PROFILE IMAGE": "Imagen de perfil",
    "FILL THE FORM": "Rellena el formulario",
    "Store": "Biblioteca",
    "SHOP": "Tienda",
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
    "Your shopping cart it's empty": "Tu carrito de compra está vacio"
  });
  
  $translateProvider.translations("ca", {
    "Genres filter": "Filtre per gènere",
    "Price filter": "Filtre per preu",
    "Post your review": "Publica el teu anàlisis",
    "Valorations": "Valoracions",
    "Video card": "Tarjeta de vídeo",
    "Hard disk": "Disc dur",
    "Memory": "Memòria",
    "Processor": "Processador",
    "Operative system": "Sistema operatiu",
    "Minimum": "Mínim",
    "Recommended": "Recomenat",
    "Game requirements": "Requisits del joc",
    "Requirements": "Requisits",
    "Owned games": "Els teus jocs",
    "SIGN": "Registrar-se",
    "FRIENDS" : "Amics",
    "Login" : "Entrar",
    "Logout" : "Tanca sessió",
    "USER INFO": "Informacio d'usuari",
    "PROFILE IMAGE": "imatge de perfil",
    "FILL THE FORM": "Omple el formulari",
    "Store": "Biblioteca",
    "SHOP": "Tenda",
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
    "Your shopping cart it's empty": "El tue carret de compra está buit"
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