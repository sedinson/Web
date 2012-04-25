/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function Ajax() {
    /*----------------------------------------------------------------------------------
     * @description: Get the AJAX Object from the specific navigator that has running
     * @example: IE, Firefox, Chrome, Opera, Safari, Konqueror...
     *--------------------------------------------------------------------------------*/
    this.getAjaxObject = function () {
        var xmlhttp = false;
        
        try {
            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(e) {
            try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(E) {
                xmlhttp = false;
            }
        }

        if(!xmlhttp && typeof XMLHttpRequest != 'undefined') {
            xmlhttp = new XMLHttpRequest();
        }
        
        return xmlhttp;
    }
    
    this.xmlhttp = this.getAjaxObject();
    
    //cargar contenido en un contenedor
    this.loadOnContainer = function (url, params, container) {
        this.xmlhttp.open("POST", url, true);
        if(params != null) {
            //Send the proper header information along with the request
            this.xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            this.xmlhttp.setRequestHeader("Content-length", params.length);
            this.xmlhttp.setRequestHeader("Connection", "close");
        }
        
        var _this = this;
        
        this.xmlhttp.onreadystatechange = function () {
            if (_this.xmlhttp.status == 200) {
                if (_this.xmlhttp.readyState == 4) {
                    container.innerHTML = _this.xmlhttp.responseText;
                } else {
                    container.innerHTML = "Loading";
                }
            } else {
                container.innerHTML = "<b>Error " + _this.xmlhttp.status + "</b>: " + _this.xmlhttp.statusText;
            }
        }
        
        this.xmlhttp.send(params);
    }
    
    //Cargar contenido controlado por funciones
    this.loadOnFunction = function (url, params, onLoaded, onError) {
        this.xmlhttp.open("POST", url, true);
        if(params != null) {
            //Send the proper header information along with the request
            this.xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            this.xmlhttp.setRequestHeader("Content-length", params.length);
            this.xmlhttp.setRequestHeader("Connection", "close");
        }
        
        var _this = this;
        
        this.xmlhttp.onreadystatechange = function () {
            if (_this.xmlhttp.status == 200) {
                if (_this.xmlhttp.readyState == 4) {
                    onLoaded(_this.xmlhttp.responseText);
                }
            } else {
                if(onError != null)
                    onError(_this.xmlhttp.status, _this.xmlhttp.statusText);
            }
        }
        
        this.xmlhttp.send(params);
    }
    
    //Cargar y obtener el texto
    this.getText = function (url, params) {
        this.xmlhttp.open("POST", url, true);
        if(params != null) {
            //Send the proper header information along with the request
            this.xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            this.xmlhttp.setRequestHeader("Content-length", params.length);
            this.xmlhttp.setRequestHeader("Connection", "close");
        }
        
        var _this = this;
        
        this.xmlhttp.onreadystatechange = function () {
            if (_this.xmlhttp.status == 200 && _this.xmlhttp.readyState == 4) {
                    return _this.xmlhttp.responseText;
            } else
                return null;
        }
        
        this.xmlhttp.send(params);
    }
    
    this.arrayToParams = function (array) {
        var str = "";
        var sep = "";
        for (var key in array) {
            str += sep + key + "=" + array[key];
            sep = "&";
        }
        
        return str;
    }
}