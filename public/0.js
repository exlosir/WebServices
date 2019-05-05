(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/profile/AddRoleComponent.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/profile/AddRoleComponent.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      checkbox: false,
      checkboxVal: ''
    };
  },
  methods: {
    update: function update() {
      if (this.checkbox) {
        this.addRole();
        this.checkboxVal = 'Мастер';
      } else {
        this.delRole();
        this.checkboxVal = 'Не мастер';
      }
    },
    addRole: function addRole() {
      axios.post('/profile/add-role', {
        roleName: 'Исполнитель'
      });
    },
    delRole: function delRole() {
      axios.post('/profile/del-role', {
        roleName: 'Исполнитель'
      });
    },
    getRole: function getRole() {
      var _this = this;

      axios.get('/profile/get-role', {
        params: {
          roleName: 'Исполнитель'
        }
      }).then(function (resp) {
        // console.log('getrole = ' + resp.data);
        _this.checkbox = resp.data; // console.log(this.checkbox);
      });
    }
  },
  mounted: function mounted() {
    this.getRole(); // console.log(this.checkbox);

    if (this.checkbox) {
      this.checkboxVal = 'Мастер';
      console.log(this.checkbox);
    } else {
      this.checkboxVal = 'Не мастер';
      console.log(this.checkbox);
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/profile/AddRoleComponent.vue?vue&type=template&id=672501d2&":
/*!***************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/profile/AddRoleComponent.vue?vue&type=template&id=672501d2& ***!
  \***************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      staticClass: "tab-pane fade pl-3",
      attrs: {
        id: "nav-add-role",
        role: "tabpanel",
        "aria-labelledby": "nav-add-role-tab"
      }
    },
    [
      _c("h4", { staticClass: "lead mt-3" }, [
        _vm._v(
          "Чтобы получить возможность исполнять заказы, отметье галочкой поле"
        )
      ]),
      _vm._v(" "),
      _c("form", { staticClass: "form-inline", attrs: { action: "/" } }, [
        _c(
          "div",
          { staticClass: "custom-control custom-checkbox my-1 mr-sm-2" },
          [
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.checkbox,
                  expression: "checkbox"
                }
              ],
              staticClass: "custom-control-input pl-3",
              attrs: {
                type: "checkbox",
                id: "customControlInline",
                value: "checkboxValue"
              },
              domProps: {
                checked: Array.isArray(_vm.checkbox)
                  ? _vm._i(_vm.checkbox, "checkboxValue") > -1
                  : _vm.checkbox
              },
              on: {
                change: [
                  function($event) {
                    var $$a = _vm.checkbox,
                      $$el = $event.target,
                      $$c = $$el.checked ? true : false
                    if (Array.isArray($$a)) {
                      var $$v = "checkboxValue",
                        $$i = _vm._i($$a, $$v)
                      if ($$el.checked) {
                        $$i < 0 && (_vm.checkbox = $$a.concat([$$v]))
                      } else {
                        $$i > -1 &&
                          (_vm.checkbox = $$a
                            .slice(0, $$i)
                            .concat($$a.slice($$i + 1)))
                      }
                    } else {
                      _vm.checkbox = $$c
                    }
                  },
                  function($event) {
                    return _vm.update()
                  }
                ]
              }
            }),
            _vm._v(" "),
            _c(
              "label",
              {
                staticClass: "custom-control-label",
                attrs: { for: "customControlInline" }
              },
              [_vm._v(_vm._s(_vm.checkboxVal))]
            )
          ]
        )
      ])
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/profile/AddRoleComponent.vue":
/*!**************************************************************!*\
  !*** ./resources/js/components/profile/AddRoleComponent.vue ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AddRoleComponent_vue_vue_type_template_id_672501d2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AddRoleComponent.vue?vue&type=template&id=672501d2& */ "./resources/js/components/profile/AddRoleComponent.vue?vue&type=template&id=672501d2&");
/* harmony import */ var _AddRoleComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AddRoleComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/profile/AddRoleComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _AddRoleComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AddRoleComponent_vue_vue_type_template_id_672501d2___WEBPACK_IMPORTED_MODULE_0__["render"],
  _AddRoleComponent_vue_vue_type_template_id_672501d2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/profile/AddRoleComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/profile/AddRoleComponent.vue?vue&type=script&lang=js&":
/*!***************************************************************************************!*\
  !*** ./resources/js/components/profile/AddRoleComponent.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AddRoleComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./AddRoleComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/profile/AddRoleComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AddRoleComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/profile/AddRoleComponent.vue?vue&type=template&id=672501d2&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/components/profile/AddRoleComponent.vue?vue&type=template&id=672501d2& ***!
  \*********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AddRoleComponent_vue_vue_type_template_id_672501d2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./AddRoleComponent.vue?vue&type=template&id=672501d2& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/profile/AddRoleComponent.vue?vue&type=template&id=672501d2&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AddRoleComponent_vue_vue_type_template_id_672501d2___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AddRoleComponent_vue_vue_type_template_id_672501d2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);