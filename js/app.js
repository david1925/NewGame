
(function(){
 angular.module("NewGameApp",["pascalprecht.translate",'angularUtils.directives.dirPagination']);


   angular.module("NewGameApp").config(['$translateProvider', function ($translateProvider) {
  $translateProvider.translations("en", {
    "SIGN": "Sign in",
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
    "Forums": "Forums"

  });
 
  $translateProvider.translations("es", {
    "SIGN": "Registrarse",
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
    "Forums": "Foros"
  });
  
  $translateProvider.translations("ca", {
    "SIGN": "Registrar-se",
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
    "Forums": "Fòrums"
  });
 

  $translateProvider.preferredLanguage(localStorage.getItem("language"));
  $translateProvider.useSanitizeValueStrategy("escapeParameters"); 
}]);

angular.module("NewGameApp").factory('Domain', function(){
	return "http://www.newgame.local/";
})

angular.module("NewGameApp").factory('LoginFactory', function(){
	var loginArray = [
	address ="",
	email="",
	firstname="",
	id="",
	image="",
	language="",
	lastname="",
	name="",
	phone="",
	profile="",
	status="",
	summary="",
	username=""];

	return loginArray;
})

})();