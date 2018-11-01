/**
 * Petite classe permettant de faire des requête AJAX
 * basé sur la librairie jQuery
 * encapsulé sur le modèle de la Promise JS
 * HERMES
 */

 var Hermes = {
     /**
      * Permet de faire un GET
      * @param {String} sUrl L'URL du point d'API
      * @param {Object} oData Les données à envoyer
      * @return {Object} || {Error Logs} Les données, ou l'erreur
      */
     get : function (sUrl, oData) {
         var self = this;
        return new Promise(function(fnResolve, fnReject) {
            $.ajax({
                url : sUrl,
                type : 'GET',
                data: oData,
                success : function(res){ // success est toujours en place, bien sûr !
                    var sJSON = self._fixJSON(res);
                    var oResponse = JSON.parse(sJSON);
                    fnResolve(oResponse);
                },
                error : function(err){
                    fnReject(err);
                }
         
             });
        });
     },
     /**
      * Permet de fixer le JSON si ce-dernier comporte notamment des retours à la ligne, etc.
      * @param {String} str Le JSON string en entrée
      * @return {JSON} Le JSON corrigé si besoin
      */
     _fixJSON : function (str) {
        return str.replace(/\n/g, "\\\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t");
     }
 }