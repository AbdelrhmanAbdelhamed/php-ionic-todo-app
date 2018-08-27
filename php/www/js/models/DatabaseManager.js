"use strict";
app.factory('DatabaseManager', function ($http) {

    /**
     * [Storage Manager]
     * @type {Object: Storage}
     */

    var DatabaseManager = augment.defclass({
        constructor: function () {

        },
        /**
         * [Search for a user in the local Storage]
         * @param  {string} Email [Email of the user to search]
         * @return {Object: User}       [return the located user]
         */
        getUser: function (email, password, ajaxUser) {

            $http({
                method: "POST",
                url: "http://localhost/todoapp/user/getUser",
                data: {Email: email, Password: password}
            }).success(function (user) {
                ajaxUser(user);
            });
        },
        /**
         * [Save user into the local Storage]
         * @param  {Object: User} user [The user to save]
         */
        saveUser: function (user, ajaxResponse) {
            $http.post("http://localhost/todoapp/user/addUser", user).
                    success(function (data) {
                        ajaxResponse(data);
                    });
        },
        getCurrentUserData: function () {

            if (typeof window.sessionStorage.currentUser !== 'undefined' && window.sessionStorage.currentUser !== null) {
                var Data = JSON.parse(window.sessionStorage.currentUser);
                return Data;
            }
            return null;
        },
        saveToDo: function (todo, ajaxResponse) {
            $http.post("http://localhost/todoapp/todo/addToDo", todo).
                    success(function (data) {
                        ajaxResponse(data);
                    });
        },
        removeToDo: function (Id, ajaxResponse) {
            $http({
                method: "POST",
                url: "http://localhost/todoapp/todo/removeToDo",
                data: {Id: Id}
            }).success(function (response) {
                ajaxResponse(response);
            });
        },
        updateToDo: function (todo) {
            $http.put("http://localhost/todoapp/todo/updateToDo", todo).
                    success(function (data) {
                    });
        },
        getAllToDos: function (userId, ajaxResponse) {
            $http.get("http://localhost/todoapp/user/getAllToDos/" + userId).then(function (todos) {
                ajaxResponse(todos.data);
            });
        }
    });
    return DatabaseManager;
});