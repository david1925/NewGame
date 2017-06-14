
(function(){
 angular.module("NewGameApp",["pascalprecht.translate",'angularUtils.directives.dirPagination', 'ngRoute']);


   angular.module("NewGameApp").config(['$translateProvider', function ($translateProvider) {
  $translateProvider.translations("en", {
  	"Wall": "Wall",
  	"Friends list": "Friends list",
  	"Purchased games": "Purchased games",
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
    "User profile": "User profile",
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
    "Your shopping cart it's empty": "Your shopping cart it's empty",
    "Check your email, a confirmation link has been sent": "Check your email, a confirmation link has been sent",
    "Congratulations, your email has been sent correctly, we will reply you as soon as possible": "Congratulations, your email has been sent correctly, we will reply you as soon as possible"

  });
 
  $translateProvider.translations("es", {
  	"Wall": "Muro",
  	"Friends list": "Lista de amigos",
  	"Purchased games": "Juegos comprados",
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
    "User profile": "Perfil de usuario",
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
    "Your shopping cart it's empty": "Tu carrito de compra está vacio",
    "Check your email, a confirmation link has been sent": "Revisa tu correo, se te ha enviado un link de confirmación",
    "Congratulations, your email has been sent correctly, we will reply you as soon as possible": "Felicidades, tu correo se ha enviado correctamente, te responderemos con la mayor brevedad posible"
  });
  
  $translateProvider.translations("ca", {
  	"Wall": "Mur",
  	"Friends list": "Llista d'amics",
  	"Purchased games": "Jocs comprats",
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
    "User profile": "Perfil d'usuari",
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
    "Your shopping cart it's empty": "El teu carret de compra está buit",
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