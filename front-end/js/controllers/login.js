angular.module('practicaPHP01.controllers')
    /**
     * Inicia la sesión del usuario en el sistema.
     */
    .controller('LoginController', ['$scope', 'UserService', '$location',
        function($scope, UserService, $location) {
            $scope.init = function() {
                console.debug('Login');
                UserService.IsLoggedIn;

                var hasSession = UserService.IsLoggedIn;

                if (hasSession) {
                    $location.path('#/home');
                }
                /**
                 * TODO: Implementar
                 * Pasos
                 * - Verifique si el usuario tiene una sesión activa.
                 * - Maneje los siguientes escenarios:
                 *  - El usuario tiene una sesión activa, envie el usuario a la ruta de `home`.
                 *  - No tiene una sesión activa, permita que la pagina de inicio de sesión funcione normalmente.
                 * - En el segundo caso, permítale al usuario iniciar una sesión en el sistema.
                 * - Agregue las validaciones necesarias: contenido vacio, correo en formato de correo.
                 * - Provea mensajes de error descriptivos.
                 */
            };
            $scope.logIn = function(){
           
            };

            $scope.init();
        }]);
