/**
 * Petite classe permettant de faire un routeur front
 * Victor MAHE MIT Licence
 * @param {String} sAppId L'id de la div servant d'App. C'est dans cette div que les components seront chargés
 * @param {Array} aRoutes - Le tableau des routes
 * Exemple de route unitaire : 
 *  {
 *      name: 'myRoute', Le nom que vous souhaitez donner à votre route
 *      componentId : 'panel01', L'id du component à charger en cas de match de la pattern
 *      pattern: '/myroute' La pattern de la route
 *  }
 */
var Compass = {
    _appId:'',
    _routes: [],

    start : function (sAppId, aRoutes) {
        if(!sAppId) {
            console.error('Merci de renseigner l\'id de votre App');
            return;
        }
        this._appId = '#' + sAppId;
        if(!aRoutes) {
            console.error('Merci de renseigner la config de vos routes en second paramètre.');
            return;
        }
        this._routes = aRoutes;
        this._fixUrl();
        this._go();
        this._startListening();
    },
    navigate : function (sPattern) {
        window.location.href = window.location.href.split('#')[0] + '#' + sPattern;
    },
    _fixUrl : function () {
        var sNavUrl = window.location.href;
        if(!sNavUrl.includes('#')) {
            window.location.href = window.location.href + '#';
        }
    },
    _getCurrentPattern : function () {
        var sPattern = window.location.href.split('#')[1];
        if(sPattern && this._isPatternExisting(sPattern)) {
            return sPattern;
        } else {
            return false;
        }
    },
    _displayTheRightView : function (sPattern) {
        var aRoutes = this._routes;
        for(var i = 0; i < aRoutes.length ; i++) {
            if(aRoutes[i].pattern === sPattern) {
                $('#' + aRoutes[i].componentId).css('display', 'block');
            } else {
                $('#' + aRoutes[i].componentId).css('display', 'none');
            }
        }
    },
    _go : function () {
        var sPattern = this._getCurrentPattern();
        if(sPattern) {
            console.log("Route détectée : " + sPattern);
            this._displayTheRightView(sPattern);
        } else {
            console.log("Aucune route trouvée. Déploiement de la vue par défaut");
            this._displayTheRightView('/welcome');
            window.location.href = window.location.href.split('#')[0] + '#' + '/welcome';
        }
    },
    _startListening : function () {
        window.addEventListener('hashchange', function() {
            this._go();
        }.bind(this));
    },
    _isPatternExisting : function (sPattern) {
        var aRoutes = this._routes;

        for(var i = 0 ; i < aRoutes.length; i++) {
            if(sPattern === aRoutes[i].pattern) {
                return true;
            }
        }
        return false;
    }
}