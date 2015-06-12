/*
 * This file is part of the Sulu CMS.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

define([
    'app-config', 
    'config', 
    'websocket-manager',
    'text!./collaborator-list.html'
    ], function(AppConfig, Config, WebsocketManager, collaboratorListTpl) {

    'use strict';

    var WEBSOCKET_APP_NAME = 'admin',
        MESSAGE_HANDLER_NAME = 'sulu_content.collaboration';

    return {
        /**
         * @method initialize
         */
        initialize: function() {
            this.client = WebsocketManager.getClient(WEBSOCKET_APP_NAME, true);

            this.bindEvents();
            this.onMessageHandler();
            this.sendEnterMessage()
                .then(this.onEnterResponse.bind(this));
        },

        /**
         * @method bindEvents
         */
        bindEvents: function() {
            this.sandbox.on('sulu.router.navigate', this.sendLeaveMessage.bind(this));
        },

        /**
         * @method onMessageHandler
         */
        onMessageHandler: function() {
            this.client.addHandler(MESSAGE_HANDLER_NAME, function(data) {
                switch (data.command) {
                    case 'update':
                        this.onUpdate(data);
                        break;
                }
            }.bind(this));
        },

        /**
         * @method sendEnterMessage
         */
        sendEnterMessage: function() {
            return this.client.send(MESSAGE_HANDLER_NAME, {
                command: 'enter',
                id: this.options.id,
                webspace: this.options.webspace,
                userId: this.options.userId,
                type: this.options.type
            });
        },

        /**
         * @method onEnterResponse
         * @param {String} handlerName
         * @param {Object} message
         */
        onEnterResponse: function(handlerName, message) {
            console.log('collaboration', message);
            this.renderCollaborators(message.users);
        },

        /**
         * @method sendLeaveMessage
         */
        sendLeaveMessage: function() {
            return this.client.send(MESSAGE_HANDLER_NAME, {
                command: 'leave',
                id: this.options.id,
                webspace: this.options.webspace,
                userId: this.options.userId,
                type: this.options.type
            });
        },

        /**
         * @method onUpdate
         * @param {Object} data
         */
        onUpdate: function(data) {
            this.renderCollaborators(data.users);
        },

        /**
         * @method renderCollaborators
         * @param {Array} collaborators
         */
        renderCollaborators: function(collaborators) {
            var template = this.sandbox.util.template(collaboratorListTpl, {
                collaborators: collaborators,
                authUserId: this.options.userId
            });

            this.$el.html(template);
        }
    };
});
