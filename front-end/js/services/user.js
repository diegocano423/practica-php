angular.module('practicaPHP01.services')
    .service('UserService', ['$http', 'ClientStorage', '$location', function ($http, ClientStorage, $location) {
        var absoluteUrl = $location.absUrl();
        var login = function(email, password) {
            var result = {
                success: false,
                message: null
            };

            if (email && password) {
                return $http({
                    method: 'POST',
                    url: absoluteUrl + '/back-end/user/login',
                    data: {"email": email, "password": password},
                })
            }

            /**
             * TODO: Implementar
             * Pasos
             * - Asegúrese que tanto el email y el password estén definidos.
             * - Llame al backend con los datos del formulario (URL: `/back-end/user/login`).
             * - Basado en la respuesta, maneje los siguientes escenarios:
             *  - El email y password son correctos.
             *  - El email no está registrado.
             *  - El password es inválido.
             * - Si el primer escenario ocurre almacene un objeto usando `ClientStorage` que contenga el email y el
             * nombre del usuario en sesión.
             */

            return result;
        };

        /**
         * Cierra la sesión del usuario.
         *
         * @returns {boolean}
         */
        var logout = function logout() {
            var result = {
                success: false,
                message: null
            };

            /**
             * TODO: Implementar
             * Pasos
             * - Elimine la información del usuario de `ClientStorage`.
             * - Llame al back-end para que cerrar la sesión en el back-end (URL: `/back-end/user/logout`).
             * - Verifique que se eliminaron los datos correctamente.
             * - Maneje los siguientes escenarios:
             *  - No existían datos.
             *  - Los datos fueron correctamente eliminados.
             *  - Los datos no fueron eliminados correctamente.
             * - En los casos 1 y 2, retorne `true` como valor de esta función.
             * - Para el caso 3, retorne `false`.
             * - IMPORTANTE: recuerde que PHP crea un cookie y PHP debe eliminarlo, de eso depende el valor del retorno
             * de la función `logout`.
             */

            return result;
        };

        /**
         * Registra un usuario en el sistema.
         *
         * @param email
         * @param password
         *
         */
        var register = function register(email, password) {
            var result = {
                success: false,
                message: null
            };

            /**
             * TODO: Implementar
             * Pasos
             * - Asegúrese que tanto el email, el password y la confirmación de password estén definidos.
             * - Asegúrese que el password y la confirmación de password sean iguales.
             * - Llame al backend con los datos del formulario (URL: `/back-end/user/register`).
             * - Basado en la respuesta, maneje los siguientes escenarios:
             *  - El email no está registrado en el sistema y los contraseñas son válidas.
             *  - El email no está registrado en el sistema y las contraseñas son inválidas.
             *  - El email ya está registrado en el sistema.
             * - Retorne `true` en el primer caso, en caso contrario retorne `false` y un mensaje de error.
             */

            return result;
        };

        /**
         * Revisa si el usuario tiene una sesión activa.
         *
         * @returns {boolean}
         */
        var isLoggedIn = function isLoggedIn() {
            var result = {
                success: false,
                message: null
            };

            var currentSession = ClientStorage.get('phpSession');

            if (currentSession){
                result.success = true;
                result.message = 'Active session';
            } else {
                result.message = 'No active session.';
            }

            /**
             * TODO: Implementar
             * Pasos
             * - Verifique si existe algún dato en `ClientStorage`.
             * - Maneje los siguientes escenarios:
             *  - Si existe algún dato, el usuario tiene sesión activa.
             *  - No existe ningún dato, el usuario no cuenta con sesión activa.
             */

            return result;
        };

        /**
         * Obtiene información sobre el usuario actual.
         *
         * @returns {{email: string, fullName: string}}|null
         */
        var getCurrentUser = function getCurrentUser() {
            var user = {
                email: null,
                fullName: null
            };

            /**
             * TODO: Implementar
             * Pasos
             * - Verifique que el usuario tenga sesión activa.
             * - Maneje los siguientes escenarios:
             *  - El usuario tiene sesión activa, retorne un objeto con el email del usuario.
             *  - El usuario no tiene sesión activa, retorne `null`.
             */

            return user;
        };

        return {
            getCurrentUser: getCurrentUser,
            isLoggedIn: isLoggedIn,
            login: login,
            logout: logout,
            register: register
        };
    }]);
