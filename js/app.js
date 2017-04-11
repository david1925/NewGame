
(function(){
 angular.module("NewGameApp",["pascalprecht.translate",'angularUtils.directives.dirPagination']);


   angular.module("NewGameApp").config(['$translateProvider', function ($translateProvider) {
  $translateProvider.translations("en", {
    "SIGN": "Sign in",
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
    "Language": "Language"
  });
 
  $translateProvider.translations("es", {
    "SIGN": "Registrarse",
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
    "Language": "Idioma"
  });
  
  $translateProvider.translations("ca", {
    "SIGN": "Registrar-se",
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
    "Language": "Idioma"
  });
 

  $translateProvider.preferredLanguage(localStorage.getItem("language"));
  $translateProvider.useSanitizeValueStrategy("escapeParameters"); 
}]); 
  
})();