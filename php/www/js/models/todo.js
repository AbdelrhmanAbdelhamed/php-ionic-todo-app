"use strict";

app.factory('ToDo', function (DatabaseManager) {

    /**
     * [a ToDo class]
     * @param  {string} description [Description of the ToDO]
     * @param  {string} remainder   [strong formatted date of starting for the ToDO]
     */
    var ToDo = augment(DatabaseManager, function (Parent) {

        this.constructor = function (description, remainder, isDone, userId) {
            this.Description = description;
            this.Remainder = remainder;
            this.isDone = isDone;
            this.userId = userId;
        };

        /**
         * Save the toDo into the current user list]
         */
        this.Save = function (verify) {
            this.saveToDo(this, function (response) {
                if (response === 'false') {
                    verify(false);
                }

                else {
                    verify(response);
                }
            });
        };

        this.Update = function () {
            this.updateToDo(this);
        };

        this.setDone = function (status) {
            this.isDone = status;
        };

        this.Remove = function (verify) {
            this.removeToDo(this.Id, function (status) {
                if (status == 'false')
                    return false;

                else
                    return true;
            });
        };

        this.setId = function (Id) {
            this.Id = Id;
        };

    });
    
    return ToDo;
});