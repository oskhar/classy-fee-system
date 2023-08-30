/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/admin/dashboard.js":
/*!*****************************************!*\
  !*** ./resources/js/admin/dashboard.js ***!
  \*****************************************/
/***/ (() => {

$(function () {
  //-------------
  //- BAR CHART -
  //-------------
  var areaChartData = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [{
      label: "Pemasukan",
      backgroundColor: "rgba(40,167,69,0.9)",
      borderColor: "rgba(40,167,69,0.8)",
      pointRadius: false,
      pointColor: "#3b8bba",
      pointStrokeColor: "rgba(40,167,69,1)",
      pointHighlightFill: "#fff",
      pointHighlightStroke: "rgba(40,167,69,1)",
      data: [28, 48, 40, 19, 86, 27, 90]
    }, {
      label: "Pengeluaran",
      backgroundColor: "rgba(220,53,69,0.9)",
      borderColor: "rgba(220,53,69,0.8)",
      pointRadius: false,
      pointColor: "#3b8bba",
      pointStrokeColor: "rgba(220,53,69,1)",
      pointHighlightFill: "#fff",
      pointHighlightStroke: "rgba(220,53,69,1)",
      data: [32, 61, 12, 39, 6, 62, 21]
    }]
  };
  console.log(areaChartData);
  var barChartCanvas = $("#barChart").text("tesdoang");
  var barChartData = $.extend(true, {}, areaChartData);
  for (var i = 0; i < areaChartData.datasets.length; i++) {
    var temp = areaChartData.datasets[i];
    barChartData.datasets[i] = temp;
  }
  var barChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    datasetFill: false
  };
  new Chart(barChartCanvas, {
    type: "bar",
    data: barChartData,
    options: barChartOptions
  });
});

/***/ }),

/***/ "./resources/css/admin/data_kelas.css":
/*!********************************************!*\
  !*** ./resources/css/admin/data_kelas.css ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/admin/data_kelas_create.css":
/*!***************************************************!*\
  !*** ./resources/css/admin/data_kelas_create.css ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/admin/data_kelas_update.css":
/*!***************************************************!*\
  !*** ./resources/css/admin/data_kelas_update.css ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/admin/data_tahun_ajar.css":
/*!*************************************************!*\
  !*** ./resources/css/admin/data_tahun_ajar.css ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/admin/data_tahun_ajar_create.css":
/*!********************************************************!*\
  !*** ./resources/css/admin/data_tahun_ajar_create.css ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/template_admin.css":
/*!******************************************!*\
  !*** ./resources/css/template_admin.css ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/admin/data_siswa.css":
/*!********************************************!*\
  !*** ./resources/css/admin/data_siswa.css ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/admin/data_jurusan.css":
/*!**********************************************!*\
  !*** ./resources/css/admin/data_jurusan.css ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/admin/data_jurusan_create.css":
/*!*****************************************************!*\
  !*** ./resources/css/admin/data_jurusan_create.css ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/admin/data_jurusan_update.css":
/*!*****************************************************!*\
  !*** ./resources/css/admin/data_jurusan_update.css ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/admin/dashboard": 0,
/******/ 			"css/admin/data_jurusan_update": 0,
/******/ 			"css/admin/data_jurusan_create": 0,
/******/ 			"css/admin/data_jurusan": 0,
/******/ 			"css/admin/data_siswa": 0,
/******/ 			"css/template_admin": 0,
/******/ 			"css/admin/data_tahun_ajar_create": 0,
/******/ 			"css/admin/data_tahun_ajar": 0,
/******/ 			"css/admin/data_kelas_update": 0,
/******/ 			"css/admin/data_kelas_create": 0,
/******/ 			"css/admin/data_kelas": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkclassy_fee_system"] = self["webpackChunkclassy_fee_system"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/admin/data_jurusan_update","css/admin/data_jurusan_create","css/admin/data_jurusan","css/admin/data_siswa","css/template_admin","css/admin/data_tahun_ajar_create","css/admin/data_tahun_ajar","css/admin/data_kelas_update","css/admin/data_kelas_create","css/admin/data_kelas"], () => (__webpack_require__("./resources/js/admin/dashboard.js")))
/******/ 	__webpack_require__.O(undefined, ["css/admin/data_jurusan_update","css/admin/data_jurusan_create","css/admin/data_jurusan","css/admin/data_siswa","css/template_admin","css/admin/data_tahun_ajar_create","css/admin/data_tahun_ajar","css/admin/data_kelas_update","css/admin/data_kelas_create","css/admin/data_kelas"], () => (__webpack_require__("./resources/css/template_admin.css")))
/******/ 	__webpack_require__.O(undefined, ["css/admin/data_jurusan_update","css/admin/data_jurusan_create","css/admin/data_jurusan","css/admin/data_siswa","css/template_admin","css/admin/data_tahun_ajar_create","css/admin/data_tahun_ajar","css/admin/data_kelas_update","css/admin/data_kelas_create","css/admin/data_kelas"], () => (__webpack_require__("./resources/css/admin/data_siswa.css")))
/******/ 	__webpack_require__.O(undefined, ["css/admin/data_jurusan_update","css/admin/data_jurusan_create","css/admin/data_jurusan","css/admin/data_siswa","css/template_admin","css/admin/data_tahun_ajar_create","css/admin/data_tahun_ajar","css/admin/data_kelas_update","css/admin/data_kelas_create","css/admin/data_kelas"], () => (__webpack_require__("./resources/css/admin/data_jurusan.css")))
/******/ 	__webpack_require__.O(undefined, ["css/admin/data_jurusan_update","css/admin/data_jurusan_create","css/admin/data_jurusan","css/admin/data_siswa","css/template_admin","css/admin/data_tahun_ajar_create","css/admin/data_tahun_ajar","css/admin/data_kelas_update","css/admin/data_kelas_create","css/admin/data_kelas"], () => (__webpack_require__("./resources/css/admin/data_jurusan_create.css")))
/******/ 	__webpack_require__.O(undefined, ["css/admin/data_jurusan_update","css/admin/data_jurusan_create","css/admin/data_jurusan","css/admin/data_siswa","css/template_admin","css/admin/data_tahun_ajar_create","css/admin/data_tahun_ajar","css/admin/data_kelas_update","css/admin/data_kelas_create","css/admin/data_kelas"], () => (__webpack_require__("./resources/css/admin/data_jurusan_update.css")))
/******/ 	__webpack_require__.O(undefined, ["css/admin/data_jurusan_update","css/admin/data_jurusan_create","css/admin/data_jurusan","css/admin/data_siswa","css/template_admin","css/admin/data_tahun_ajar_create","css/admin/data_tahun_ajar","css/admin/data_kelas_update","css/admin/data_kelas_create","css/admin/data_kelas"], () => (__webpack_require__("./resources/css/admin/data_kelas.css")))
/******/ 	__webpack_require__.O(undefined, ["css/admin/data_jurusan_update","css/admin/data_jurusan_create","css/admin/data_jurusan","css/admin/data_siswa","css/template_admin","css/admin/data_tahun_ajar_create","css/admin/data_tahun_ajar","css/admin/data_kelas_update","css/admin/data_kelas_create","css/admin/data_kelas"], () => (__webpack_require__("./resources/css/admin/data_kelas_create.css")))
/******/ 	__webpack_require__.O(undefined, ["css/admin/data_jurusan_update","css/admin/data_jurusan_create","css/admin/data_jurusan","css/admin/data_siswa","css/template_admin","css/admin/data_tahun_ajar_create","css/admin/data_tahun_ajar","css/admin/data_kelas_update","css/admin/data_kelas_create","css/admin/data_kelas"], () => (__webpack_require__("./resources/css/admin/data_kelas_update.css")))
/******/ 	__webpack_require__.O(undefined, ["css/admin/data_jurusan_update","css/admin/data_jurusan_create","css/admin/data_jurusan","css/admin/data_siswa","css/template_admin","css/admin/data_tahun_ajar_create","css/admin/data_tahun_ajar","css/admin/data_kelas_update","css/admin/data_kelas_create","css/admin/data_kelas"], () => (__webpack_require__("./resources/css/admin/data_tahun_ajar.css")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/admin/data_jurusan_update","css/admin/data_jurusan_create","css/admin/data_jurusan","css/admin/data_siswa","css/template_admin","css/admin/data_tahun_ajar_create","css/admin/data_tahun_ajar","css/admin/data_kelas_update","css/admin/data_kelas_create","css/admin/data_kelas"], () => (__webpack_require__("./resources/css/admin/data_tahun_ajar_create.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;