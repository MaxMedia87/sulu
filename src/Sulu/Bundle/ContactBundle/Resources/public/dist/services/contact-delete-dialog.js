define(["services/husky/mediator"],function(a){"use strict";return{showDialog:function(b,c){0!==b.length&&a.emit("sulu.overlay.show-warning","sulu.overlay.be-careful",null,c.bind(this,!0))}}});