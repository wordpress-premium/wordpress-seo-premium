window.yoast=window.yoast||{},window.yoast.componentsNew=function(e){var t={};function o(r){if(t[r])return t[r].exports;var n=t[r]={i:r,l:!1,exports:{}};return e[r].call(n.exports,n,n.exports,o),n.l=!0,n.exports}return o.m=e,o.c=t,o.d=function(e,t,r){o.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},o.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},o.t=function(e,t){if(1&t&&(e=o(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(o.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)o.d(r,n,function(t){return e[t]}.bind(null,n));return r},o.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(t,"a",t),t},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},o.p="",o(o.s=491)}({0:function(e,t){e.exports=window.yoast.propTypes},1:function(e,t){e.exports=window.wp.element},107:function(e,t){e.exports=window.lodash.flow},113:function(e,t,o){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.canUseDOM=void 0;var r,n=((r=o(248))&&r.__esModule?r:{default:r}).default,a=n.canUseDOM?window.HTMLElement:{};t.canUseDOM=n.canUseDOM,t.default=a},12:function(e,t){function o(){return e.exports=o=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var o=arguments[t];for(var r in o)Object.prototype.hasOwnProperty.call(o,r)&&(e[r]=o[r])}return e},e.exports.default=e.exports,e.exports.__esModule=!0,o.apply(this,arguments)}e.exports=o,e.exports.default=e.exports,e.exports.__esModule=!0},139:function(e,t,o){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=function(e){return[].slice.call(e.querySelectorAll("*"),0).filter(a)};var r=/input|select|textarea|button|object/;function n(e){var t=e.offsetWidth<=0&&e.offsetHeight<=0;if(t&&!e.innerHTML)return!0;var o=window.getComputedStyle(e);return t?"visible"!==o.getPropertyValue("overflow")||e.scrollWidth<=0&&e.scrollHeight<=0:"none"==o.getPropertyValue("display")}function a(e){var t=e.getAttribute("tabindex");null===t&&(t=void 0);var o=isNaN(t);return(o||t>=0)&&function(e,t){var o=e.nodeName.toLowerCase();return(r.test(o)&&!e.disabled||"a"===o&&e.href||t)&&function(e){for(var t=e;t&&t!==document.body;){if(n(t))return!1;t=t.parentNode}return!0}(e)}(e,!o)}e.exports=t.default},140:function(e,t,o){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.assertNodeList=l,t.setElement=function(e){var t=e;if("string"==typeof t&&a.canUseDOM){var o=document.querySelectorAll(t);l(o,t),t="length"in o?o[0]:o}return s=t||s},t.validateElement=i,t.hide=function(e){i(e)&&(e||s).setAttribute("aria-hidden","true")},t.show=function(e){i(e)&&(e||s).removeAttribute("aria-hidden")},t.documentNotReadyOrSSRTesting=function(){s=null},t.resetForTesting=function(){s=null};var r,n=(r=o(247))&&r.__esModule?r:{default:r},a=o(113),s=null;function l(e,t){if(!e||!e.length)throw new Error("react-modal: No elements were found for selector "+t+".")}function i(e){return!(!e&&!s&&((0,n.default)(!1,["react-modal: App element is not defined.","Please use `Modal.setAppElement(el)` or set `appElement={el}`.","This is needed so screen readers don't see main content","when modal is opened. It is not recommended, but you can opt-out","by setting `ariaHideApp={false}`."].join(" ")),1))}},141:function(e,t,o){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=new function e(){var t=this;!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.register=function(e){-1===t.openInstances.indexOf(e)&&(t.openInstances.push(e),t.emit("register"))},this.deregister=function(e){var o=t.openInstances.indexOf(e);-1!==o&&(t.openInstances.splice(o,1),t.emit("deregister"))},this.subscribe=function(e){t.subscribers.push(e)},this.emit=function(e){t.subscribers.forEach((function(o){return o(e,t.openInstances.slice())}))},this.openInstances=[],this.subscribers=[]};t.default=r,e.exports=t.default},2:function(e,t){e.exports=window.lodash},219:function(e,t){e.exports=window.yoast.reactSelect},220:function(e,t,o){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r,n=(r=o(243))&&r.__esModule?r:{default:r};t.default=n.default,e.exports=t.default},243:function(e,t,o){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.bodyOpenClassName=t.portalClassName=void 0;var r=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var o=arguments[t];for(var r in o)Object.prototype.hasOwnProperty.call(o,r)&&(e[r]=o[r])}return e},n=function(){function e(e,t){for(var o=0;o<t.length;o++){var r=t[o];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(t,o,r){return o&&e(t.prototype,o),r&&e(t,r),t}}(),a=o(3),s=f(a),l=f(o(38)),i=f(o(0)),c=f(o(244)),d=function(e){if(e&&e.__esModule)return e;var t={};if(null!=e)for(var o in e)Object.prototype.hasOwnProperty.call(e,o)&&(t[o]=e[o]);return t.default=e,t}(o(140)),u=o(113),p=f(u),h=o(86);function f(e){return e&&e.__esModule?e:{default:e}}function b(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function m(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!=typeof t&&"function"!=typeof t?e:t}var g=t.portalClassName="ReactModalPortal",y=t.bodyOpenClassName="ReactModal__Body--open",v=u.canUseDOM&&void 0!==l.default.createPortal,x=function(){return v?l.default.createPortal:l.default.unstable_renderSubtreeIntoContainer};function O(e){return e()}var C=function(e){function t(){var e,o,n;b(this,t);for(var a=arguments.length,i=Array(a),d=0;d<a;d++)i[d]=arguments[d];return o=n=m(this,(e=t.__proto__||Object.getPrototypeOf(t)).call.apply(e,[this].concat(i))),n.removePortal=function(){!v&&l.default.unmountComponentAtNode(n.node);var e=O(n.props.parentSelector);e&&e.contains(n.node)?e.removeChild(n.node):console.warn('React-Modal: "parentSelector" prop did not returned any DOM element. Make sure that the parent element is unmounted to avoid any memory leaks.')},n.portalRef=function(e){n.portal=e},n.renderPortal=function(e){var o=x()(n,s.default.createElement(c.default,r({defaultStyles:t.defaultStyles},e)),n.node);n.portalRef(o)},m(n,o)}return function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}(t,e),n(t,[{key:"componentDidMount",value:function(){u.canUseDOM&&(v||(this.node=document.createElement("div")),this.node.className=this.props.portalClassName,O(this.props.parentSelector).appendChild(this.node),!v&&this.renderPortal(this.props))}},{key:"getSnapshotBeforeUpdate",value:function(e){return{prevParent:O(e.parentSelector),nextParent:O(this.props.parentSelector)}}},{key:"componentDidUpdate",value:function(e,t,o){if(u.canUseDOM){var r=this.props,n=r.isOpen,a=r.portalClassName;e.portalClassName!==a&&(this.node.className=a);var s=o.prevParent,l=o.nextParent;l!==s&&(s.removeChild(this.node),l.appendChild(this.node)),(e.isOpen||n)&&!v&&this.renderPortal(this.props)}}},{key:"componentWillUnmount",value:function(){if(u.canUseDOM&&this.node&&this.portal){var e=this.portal.state,t=Date.now(),o=e.isOpen&&this.props.closeTimeoutMS&&(e.closesAt||t+this.props.closeTimeoutMS);o?(e.beforeClose||this.portal.closeWithTimeout(),setTimeout(this.removePortal,o-t)):this.removePortal()}}},{key:"render",value:function(){return u.canUseDOM&&v?(!this.node&&v&&(this.node=document.createElement("div")),x()(s.default.createElement(c.default,r({ref:this.portalRef,defaultStyles:t.defaultStyles},this.props)),this.node)):null}}],[{key:"setAppElement",value:function(e){d.setElement(e)}}]),t}(a.Component);C.propTypes={isOpen:i.default.bool.isRequired,style:i.default.shape({content:i.default.object,overlay:i.default.object}),portalClassName:i.default.string,bodyOpenClassName:i.default.string,htmlOpenClassName:i.default.string,className:i.default.oneOfType([i.default.string,i.default.shape({base:i.default.string.isRequired,afterOpen:i.default.string.isRequired,beforeClose:i.default.string.isRequired})]),overlayClassName:i.default.oneOfType([i.default.string,i.default.shape({base:i.default.string.isRequired,afterOpen:i.default.string.isRequired,beforeClose:i.default.string.isRequired})]),appElement:i.default.instanceOf(p.default),onAfterOpen:i.default.func,onRequestClose:i.default.func,closeTimeoutMS:i.default.number,ariaHideApp:i.default.bool,shouldFocusAfterRender:i.default.bool,shouldCloseOnOverlayClick:i.default.bool,shouldReturnFocusAfterClose:i.default.bool,preventScroll:i.default.bool,parentSelector:i.default.func,aria:i.default.object,data:i.default.object,role:i.default.string,contentLabel:i.default.string,shouldCloseOnEsc:i.default.bool,overlayRef:i.default.func,contentRef:i.default.func,id:i.default.string,overlayElement:i.default.func,contentElement:i.default.func},C.defaultProps={isOpen:!1,portalClassName:g,bodyOpenClassName:y,role:"dialog",ariaHideApp:!0,closeTimeoutMS:0,shouldFocusAfterRender:!0,shouldCloseOnEsc:!0,shouldCloseOnOverlayClick:!0,shouldReturnFocusAfterClose:!0,preventScroll:!1,parentSelector:function(){return document.body},overlayElement:function(e,t){return s.default.createElement("div",e,t)},contentElement:function(e,t){return s.default.createElement("div",e,t)}},C.defaultStyles={overlay:{position:"fixed",top:0,left:0,right:0,bottom:0,backgroundColor:"rgba(255, 255, 255, 0.75)"},content:{position:"absolute",top:"40px",left:"40px",right:"40px",bottom:"40px",border:"1px solid #ccc",background:"#fff",overflow:"auto",WebkitOverflowScrolling:"touch",borderRadius:"4px",outline:"none",padding:"20px"}},(0,h.polyfill)(C),t.default=C},244:function(e,t,o){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var o=arguments[t];for(var r in o)Object.prototype.hasOwnProperty.call(o,r)&&(e[r]=o[r])}return e},n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},a=function(){function e(e,t){for(var o=0;o<t.length;o++){var r=t[o];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(t,o,r){return o&&e(t.prototype,o),r&&e(t,r),t}}(),s=o(3),l=b(o(0)),i=f(o(245)),c=b(o(246)),d=f(o(140)),u=f(o(249)),p=b(o(113)),h=b(o(141));function f(e){if(e&&e.__esModule)return e;var t={};if(null!=e)for(var o in e)Object.prototype.hasOwnProperty.call(e,o)&&(t[o]=e[o]);return t.default=e,t}function b(e){return e&&e.__esModule?e:{default:e}}o(250);var m={overlay:"ReactModal__Overlay",content:"ReactModal__Content"},g=0,y=function(e){function t(e){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t);var o=function(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!=typeof t&&"function"!=typeof t?e:t}(this,(t.__proto__||Object.getPrototypeOf(t)).call(this,e));return o.setOverlayRef=function(e){o.overlay=e,o.props.overlayRef&&o.props.overlayRef(e)},o.setContentRef=function(e){o.content=e,o.props.contentRef&&o.props.contentRef(e)},o.afterClose=function(){var e=o.props,t=e.appElement,r=e.ariaHideApp,n=e.htmlOpenClassName,a=e.bodyOpenClassName;a&&u.remove(document.body,a),n&&u.remove(document.getElementsByTagName("html")[0],n),r&&g>0&&0==(g-=1)&&d.show(t),o.props.shouldFocusAfterRender&&(o.props.shouldReturnFocusAfterClose?(i.returnFocus(o.props.preventScroll),i.teardownScopedFocus()):i.popWithoutFocus()),o.props.onAfterClose&&o.props.onAfterClose(),h.default.deregister(o)},o.open=function(){o.beforeOpen(),o.state.afterOpen&&o.state.beforeClose?(clearTimeout(o.closeTimer),o.setState({beforeClose:!1})):(o.props.shouldFocusAfterRender&&(i.setupScopedFocus(o.node),i.markForFocusLater()),o.setState({isOpen:!0},(function(){o.setState({afterOpen:!0}),o.props.isOpen&&o.props.onAfterOpen&&o.props.onAfterOpen({overlayEl:o.overlay,contentEl:o.content})})))},o.close=function(){o.props.closeTimeoutMS>0?o.closeWithTimeout():o.closeWithoutTimeout()},o.focusContent=function(){return o.content&&!o.contentHasFocus()&&o.content.focus({preventScroll:!0})},o.closeWithTimeout=function(){var e=Date.now()+o.props.closeTimeoutMS;o.setState({beforeClose:!0,closesAt:e},(function(){o.closeTimer=setTimeout(o.closeWithoutTimeout,o.state.closesAt-Date.now())}))},o.closeWithoutTimeout=function(){o.setState({beforeClose:!1,isOpen:!1,afterOpen:!1,closesAt:null},o.afterClose)},o.handleKeyDown=function(e){9===e.keyCode&&(0,c.default)(o.content,e),o.props.shouldCloseOnEsc&&27===e.keyCode&&(e.stopPropagation(),o.requestClose(e))},o.handleOverlayOnClick=function(e){null===o.shouldClose&&(o.shouldClose=!0),o.shouldClose&&o.props.shouldCloseOnOverlayClick&&(o.ownerHandlesClose()?o.requestClose(e):o.focusContent()),o.shouldClose=null},o.handleContentOnMouseUp=function(){o.shouldClose=!1},o.handleOverlayOnMouseDown=function(e){o.props.shouldCloseOnOverlayClick||e.target!=o.overlay||e.preventDefault()},o.handleContentOnClick=function(){o.shouldClose=!1},o.handleContentOnMouseDown=function(){o.shouldClose=!1},o.requestClose=function(e){return o.ownerHandlesClose()&&o.props.onRequestClose(e)},o.ownerHandlesClose=function(){return o.props.onRequestClose},o.shouldBeClosed=function(){return!o.state.isOpen&&!o.state.beforeClose},o.contentHasFocus=function(){return document.activeElement===o.content||o.content.contains(document.activeElement)},o.buildClassName=function(e,t){var r="object"===(void 0===t?"undefined":n(t))?t:{base:m[e],afterOpen:m[e]+"--after-open",beforeClose:m[e]+"--before-close"},a=r.base;return o.state.afterOpen&&(a=a+" "+r.afterOpen),o.state.beforeClose&&(a=a+" "+r.beforeClose),"string"==typeof t&&t?a+" "+t:a},o.attributesFromObject=function(e,t){return Object.keys(t).reduce((function(o,r){return o[e+"-"+r]=t[r],o}),{})},o.state={afterOpen:!1,beforeClose:!1},o.shouldClose=null,o.moveFromContentToOverlay=null,o}return function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}(t,e),a(t,[{key:"componentDidMount",value:function(){this.props.isOpen&&this.open()}},{key:"componentDidUpdate",value:function(e,t){this.props.isOpen&&!e.isOpen?this.open():!this.props.isOpen&&e.isOpen&&this.close(),this.props.shouldFocusAfterRender&&this.state.isOpen&&!t.isOpen&&this.focusContent()}},{key:"componentWillUnmount",value:function(){this.state.isOpen&&this.afterClose(),clearTimeout(this.closeTimer)}},{key:"beforeOpen",value:function(){var e=this.props,t=e.appElement,o=e.ariaHideApp,r=e.htmlOpenClassName,n=e.bodyOpenClassName;n&&u.add(document.body,n),r&&u.add(document.getElementsByTagName("html")[0],r),o&&(g+=1,d.hide(t)),h.default.register(this)}},{key:"render",value:function(){var e=this.props,t=e.id,o=e.className,n=e.overlayClassName,a=e.defaultStyles,s=e.children,l=o?{}:a.content,i=n?{}:a.overlay;if(this.shouldBeClosed())return null;var c={ref:this.setOverlayRef,className:this.buildClassName("overlay",n),style:r({},i,this.props.style.overlay),onClick:this.handleOverlayOnClick,onMouseDown:this.handleOverlayOnMouseDown},d=r({id:t,ref:this.setContentRef,style:r({},l,this.props.style.content),className:this.buildClassName("content",o),tabIndex:"-1",onKeyDown:this.handleKeyDown,onMouseDown:this.handleContentOnMouseDown,onMouseUp:this.handleContentOnMouseUp,onClick:this.handleContentOnClick,role:this.props.role,"aria-label":this.props.contentLabel},this.attributesFromObject("aria",r({modal:!0},this.props.aria)),this.attributesFromObject("data",this.props.data||{}),{"data-testid":this.props.testId}),u=this.props.contentElement(d,s);return this.props.overlayElement(c,u)}}]),t}(s.Component);y.defaultProps={style:{overlay:{},content:{}},defaultStyles:{}},y.propTypes={isOpen:l.default.bool.isRequired,defaultStyles:l.default.shape({content:l.default.object,overlay:l.default.object}),style:l.default.shape({content:l.default.object,overlay:l.default.object}),className:l.default.oneOfType([l.default.string,l.default.object]),overlayClassName:l.default.oneOfType([l.default.string,l.default.object]),bodyOpenClassName:l.default.string,htmlOpenClassName:l.default.string,ariaHideApp:l.default.bool,appElement:l.default.instanceOf(p.default),onAfterOpen:l.default.func,onAfterClose:l.default.func,onRequestClose:l.default.func,closeTimeoutMS:l.default.number,shouldFocusAfterRender:l.default.bool,shouldCloseOnOverlayClick:l.default.bool,shouldReturnFocusAfterClose:l.default.bool,preventScroll:l.default.bool,role:l.default.string,contentLabel:l.default.string,aria:l.default.object,data:l.default.object,children:l.default.node,shouldCloseOnEsc:l.default.bool,overlayRef:l.default.func,contentRef:l.default.func,id:l.default.string,overlayElement:l.default.func,contentElement:l.default.func,testId:l.default.string},t.default=y,e.exports=t.default},245:function(e,t,o){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.handleBlur=i,t.handleFocus=c,t.markForFocusLater=function(){a.push(document.activeElement)},t.returnFocus=function(){var e=arguments.length>0&&void 0!==arguments[0]&&arguments[0],t=null;try{return void(0!==a.length&&(t=a.pop()).focus({preventScroll:e}))}catch(e){console.warn(["You tried to return focus to",t,"but it is not in the DOM anymore"].join(" "))}},t.popWithoutFocus=function(){a.length>0&&a.pop()},t.setupScopedFocus=function(e){s=e,window.addEventListener?(window.addEventListener("blur",i,!1),document.addEventListener("focus",c,!0)):(window.attachEvent("onBlur",i),document.attachEvent("onFocus",c))},t.teardownScopedFocus=function(){s=null,window.addEventListener?(window.removeEventListener("blur",i),document.removeEventListener("focus",c)):(window.detachEvent("onBlur",i),document.detachEvent("onFocus",c))};var r,n=(r=o(139))&&r.__esModule?r:{default:r},a=[],s=null,l=!1;function i(){l=!0}function c(){if(l){if(l=!1,!s)return;setTimeout((function(){s.contains(document.activeElement)||((0,n.default)(s)[0]||s).focus()}),0)}}},246:function(e,t,o){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=function(e,t){var o=(0,n.default)(e);if(o.length){var r=void 0,a=t.shiftKey,s=o[0],l=o[o.length-1];if(e===document.activeElement){if(!a)return;r=l}if(l!==document.activeElement||a||(r=s),s===document.activeElement&&a&&(r=l),r)return t.preventDefault(),void r.focus();var i=/(\bChrome\b|\bSafari\b)\//.exec(navigator.userAgent);if(null!=i&&"Chrome"!=i[1]&&null==/\biPod\b|\biPad\b/g.exec(navigator.userAgent)){var c=o.indexOf(document.activeElement);if(c>-1&&(c+=a?-1:1),void 0===(r=o[c]))return t.preventDefault(),void(r=a?l:s).focus();t.preventDefault(),r.focus()}}else t.preventDefault()};var r,n=(r=o(139))&&r.__esModule?r:{default:r};e.exports=t.default},247:function(e,t,o){"use strict";e.exports=function(){}},248:function(e,t,o){var r;!function(){"use strict";var n=!("undefined"==typeof window||!window.document||!window.document.createElement),a={canUseDOM:n,canUseWorkers:"undefined"!=typeof Worker,canUseEventListeners:n&&!(!window.addEventListener&&!window.attachEvent),canUseViewport:n&&!!window.screen};void 0===(r=function(){return a}.call(t,o,t,e))||(e.exports=r)}()},249:function(e,t,o){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.dumpClassLists=function(){};var r={},n={};t.add=function(e,t){return o=e.classList,a="html"==e.nodeName.toLowerCase()?r:n,void t.split(" ").forEach((function(e){!function(e,t){e[t]||(e[t]=0),e[t]+=1}(a,e),o.add(e)}));var o,a},t.remove=function(e,t){return o=e.classList,a="html"==e.nodeName.toLowerCase()?r:n,void t.split(" ").forEach((function(e){!function(e,t){e[t]&&(e[t]-=1)}(a,e),0===a[e]&&o.remove(e)}));var o,a}},250:function(e,t,o){"use strict";var r,n=(r=o(141))&&r.__esModule?r:{default:r},a=void 0,s=void 0,l=[];function i(){0!==l.length&&l[l.length-1].focusContent()}n.default.subscribe((function(e,t){a&&s||((a=document.createElement("div")).setAttribute("data-react-modal-body-trap",""),a.style.position="absolute",a.style.opacity="0",a.setAttribute("tabindex","0"),a.addEventListener("focus",i),(s=a.cloneNode()).addEventListener("focus",i)),(l=t).length>0?(document.body.firstChild!==a&&document.body.insertBefore(a,document.body.firstChild),document.body.lastChild!==s&&document.body.appendChild(s)):(a.parentElement&&a.parentElement.removeChild(a),s.parentElement&&s.parentElement.removeChild(s))}))},3:function(e,t){e.exports=window.React},32:function(e,t,o){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},n=l(o(3)),a=l(o(65)),s=l(o(68));function l(e){return e&&e.__esModule?e:{default:e}}var i=void 0;t.default=function(e){var t=e.mixedString,o=e.components,l=e.throwErrors;if(i=t,!o)return t;if("object"!==(void 0===o?"undefined":r(o))){if(l)throw new Error("Interpolation Error: unable to process `"+t+"` because components is not an object");return t}var c=(0,s.default)(t);try{return function e(t,o){var s,l,c,d,u,p,h,f,b=[],m={};for(p=0;p<t.length;p++)if("string"!==(u=t[p]).type){if(!o.hasOwnProperty(u.value)||void 0===o[u.value])throw new Error("Invalid interpolation, missing component node: `"+u.value+"`");if("object"!==r(o[u.value]))throw new Error("Invalid interpolation, component node must be a ReactElement or null: `"+u.value+"`","\n> "+i);if("componentClose"===u.type)throw new Error("Missing opening component token: `"+u.value+"`");if("componentOpen"===u.type){s=o[u.value],c=p;break}b.push(o[u.value])}else b.push(u.value);return s&&(d=function(e,t){var o,r,n=t[e],a=0;for(r=e+1;r<t.length;r++)if((o=t[r]).value===n.value){if("componentOpen"===o.type){a++;continue}if("componentClose"===o.type){if(0===a)return r;a--}}throw new Error("Missing closing component token `"+n.value+"`")}(c,t),h=e(t.slice(c+1,d),o),l=n.default.cloneElement(s,{},h),b.push(l),d<t.length-1&&(f=e(t.slice(d+1),o),b=b.concat(f))),1===b.length?b[0]:(b.forEach((function(e,t){e&&(m["interpolation-child-"+t]=e)})),(0,a.default)(m))}(c,o)}catch(e){if(l)throw new Error("Interpolation Error: unable to process `"+t+"` because of error `"+e.message+"`");return t}}},33:function(e,t,o){var r;!function(){"use strict";var o={}.hasOwnProperty;function n(){for(var e=[],t=0;t<arguments.length;t++){var r=arguments[t];if(r){var a=typeof r;if("string"===a||"number"===a)e.push(r);else if(Array.isArray(r)&&r.length){var s=n.apply(null,r);s&&e.push(s)}else if("object"===a)for(var l in r)o.call(r,l)&&r[l]&&e.push(l)}}return e.join(" ")}e.exports?(n.default=n,e.exports=n):void 0===(r=function(){return n}.apply(t,[]))||(e.exports=r)}()},38:function(e,t){e.exports=window.ReactDOM},39:function(e,t){e.exports=window.lodash.omit},4:function(e,t){e.exports=window.wp.i18n},40:function(e,t){e.exports=window.wp.a11y},41:function(e,t,o){"use strict";function r(e){return function(){return e}}var n=function(){};n.thatReturns=r,n.thatReturnsFalse=r(!1),n.thatReturnsTrue=r(!0),n.thatReturnsNull=r(null),n.thatReturnsThis=function(){return this},n.thatReturnsArgument=function(e){return e},e.exports=n},491:function(e,t,o){"use strict";o.r(t),o.d(t,"NewButton",(function(){return A})),o.d(t,"ButtonStyledLink",(function(){return F})),o.d(t,"CloseButton",(function(){return W})),o.d(t,"Checkbox",(function(){return ne})),o.d(t,"DataModel",(function(){return ie})),o.d(t,"FieldGroup",(function(){return re})),o.d(t,"ImageSelect",(function(){return ye})),o.d(t,"ImageSelectButtons",(function(){return de})),o.d(t,"TextInput",(function(){return xe})),o.d(t,"DurationInput",(function(){return _e})),o.d(t,"RadioButtonGroup",(function(){return Re})),o.d(t,"SingleSelect",(function(){return Ae})),o.d(t,"MultiSelect",(function(){return Fe})),o.d(t,"Select",(function(){return Ue})),o.d(t,"StarRating",(function(){return We})),o.d(t,"helpIconDefaultProps",(function(){return K})),o.d(t,"helpIconProps",(function(){return V})),o.d(t,"HelpIcon",(function(){return Y})),o.d(t,"NewBadge",(function(){return X})),o.d(t,"PremiumBadge",(function(){return Q})),o.d(t,"BetaBadge",(function(){return Ve})),o.d(t,"StyledSection",(function(){return w})),o.d(t,"StyledSectionBase",(function(){return O})),o.d(t,"StyledHeading",(function(){return v})),o.d(t,"LinkButton",(function(){return R})),o.d(t,"Button",(function(){return N})),o.d(t,"BaseButton",(function(){return q})),o.d(t,"addHoverStyle",(function(){return S})),o.d(t,"addActiveStyle",(function(){return T})),o.d(t,"addFocusStyle",(function(){return k})),o.d(t,"addBaseStyle",(function(){return E})),o.d(t,"addButtonStyles",(function(){return $})),o.d(t,"Collapsible",(function(){return dt})),o.d(t,"CollapsibleStateless",(function(){return it})),o.d(t,"StyledIconsButton",(function(){return at})),o.d(t,"StyledContainer",(function(){return rt})),o.d(t,"StyledContainerTopLevel",(function(){return nt})),o.d(t,"wrapInHeading",(function(){return st})),o.d(t,"Alert",(function(){return me})),o.d(t,"ArticleList",(function(){return vt})),o.d(t,"Card",(function(){return $t})),o.d(t,"FullHeightCard",(function(){return qt})),o.d(t,"CardBanner",(function(){return Ct})),o.d(t,"CourseDetails",(function(){return Dt})),o.d(t,"IconLabeledButton",(function(){return Wt})),o.d(t,"IconButton",(function(){return Kt})),o.d(t,"IconsButton",(function(){return Ge})),o.d(t,"ErrorBoundary",(function(){return Zt})),o.d(t,"Heading",(function(){return h})),o.d(t,"HelpText",(function(){return Jt})),o.d(t,"Icon",(function(){return to})),o.d(t,"IconButtonToggle",(function(){return no})),o.d(t,"IconCTAEditButton",(function(){return lo})),o.d(t,"IFrame",(function(){return io})),o.d(t,"Input",(function(){return uo})),o.d(t,"WordOccurrenceInsights",(function(){return go})),o.d(t,"Label",(function(){return xo})),o.d(t,"SimulatedLabel",(function(){return yo})),o.d(t,"LanguageNotice",(function(){return wo})),o.d(t,"languageNoticePropType",(function(){return _o})),o.d(t,"Loader",(function(){return ko})),o.d(t,"MultiStepProgress",(function(){return Po})),o.d(t,"Notification",(function(){return Uo})),o.d(t,"Paper",(function(){return Io})),o.d(t,"ProgressBar",(function(){return Wo})),o.d(t,"Section",(function(){return b})),o.d(t,"SectionTitle",(function(){return tt})),o.d(t,"ScoreAssessments",(function(){return er})),o.d(t,"StackedProgressBar",(function(){return nr})),o.d(t,"SvgIcon",(function(){return y})),o.d(t,"icons",(function(){return g})),o.d(t,"SynonymsInput",(function(){return pr})),o.d(t,"Textarea",(function(){return fr})),o.d(t,"Textfield",(function(){return mr})),o.d(t,"Toggle",(function(){return wr})),o.d(t,"UpsellButton",(function(){return $r})),o.d(t,"UpsellLinkButton",(function(){return qr})),o.d(t,"YoastButton",(function(){return Er})),o.d(t,"InputField",(function(){return lr})),o.d(t,"YoastLinkButton",(function(){return Nr})),o.d(t,"Logo",(function(){return Rr})),o.d(t,"Modal",(function(){return Lr})),o.d(t,"YoastSeoIcon",(function(){return Dr})),o.d(t,"Tabs",(function(){return fn})),o.d(t,"Warning",(function(){return On})),o.d(t,"YouTubeVideo",(function(){return wn})),o.d(t,"WordList",(function(){return En})),o.d(t,"WordOccurrences",(function(){return bo})),o.d(t,"VariableEditorInputContainer",(function(){return ar})),o.d(t,"InsightsCard",(function(){return Ee})),o.d(t,"ListTable",(function(){return Sn})),o.d(t,"ZebrafiedListTable",(function(){return Tn})),o.d(t,"Row",(function(){return $n})),o.d(t,"ScreenReaderText",(function(){return Xe})),o.d(t,"ScreenReaderShortcut",(function(){return Nn})),o.d(t,"KeywordSuggestions",(function(){return go}));var r=o(1),n=o(3),a=o.n(n),s=o(0),l=o.n(s),i=o(5),c=o.n(i),d=o(6),u=o(9);const p=e=>{const t="h"+e.level;return Object(r.createElement)(t,{className:e.className},e.children)};p.propTypes={level:l.a.number,className:l.a.string,children:l.a.any},p.defaultProps={level:1};var h=p;const f=e=>Object(r.createElement)("section",{className:e.className},e.headingText&&Object(r.createElement)(h,{level:e.headingLevel,className:e.headingClassName},e.headingText),e.children);f.propTypes={className:l.a.string,headingText:l.a.string,headingLevel:l.a.number,headingClassName:l.a.string,children:l.a.any},f.defaultProps={headingLevel:1};var b=f;const m=c.a.svg`
	width: ${e=>e.size};
	height: ${e=>e.size};
	flex: none;

	animation: loadingSpinnerRotator 1.4s linear infinite;

	& .path {
		stroke: ${e=>e.fill};
		stroke-dasharray: 187;
		stroke-dashoffset: 0;
		transform-origin: center;
		animation: loadingSpinnerDash 1.4s ease-in-out infinite;
	}

	@keyframes loadingSpinnerRotator {
		0% { transform: rotate( 0deg ); }
		100% { transform: rotate( 270deg ); }
	}

	@keyframes loadingSpinnerDash {
		0% { stroke-dashoffset: 187; }
		50% {
			stroke-dashoffset: 47;
			transform:rotate( 135deg );
		}
		100% {
			stroke-dashoffset: 187;
			transform: rotate( 450deg );
		}
	}
`,g={"chevron-down":{viewbox:"0 0 24 24",width:"24px",path:[Object(r.createElement)("g",{key:"1"},Object(r.createElement)("path",{fill:"none",d:"M0,0h24v24H0V0z"})),Object(r.createElement)("g",{key:"2"},Object(r.createElement)("path",{d:"M7.41,8.59L12,13.17l4.59-4.58L18,10l-6,6l-6-6L7.41,8.59z"}))]},"chevron-up":{viewbox:"0 0 24 24",width:"24px",path:[Object(r.createElement)("g",{key:"1"},Object(r.createElement)("path",{fill:"none",d:"M0,0h24v24H0V0z"})),Object(r.createElement)("g",{key:"2"},Object(r.createElement)("path",{d:"M12,8l-6,6l1.41,1.41L12,10.83l4.59,4.58L18,14L12,8z"}))]},clipboard:{viewbox:"0 0 1792 1792",path:"M768 1664h896v-640h-416q-40 0-68-28t-28-68v-416h-384v1152zm256-1440v-64q0-13-9.5-22.5t-22.5-9.5h-704q-13 0-22.5 9.5t-9.5 22.5v64q0 13 9.5 22.5t22.5 9.5h704q13 0 22.5-9.5t9.5-22.5zm256 672h299l-299-299v299zm512 128v672q0 40-28 68t-68 28h-960q-40 0-68-28t-28-68v-160h-544q-40 0-68-28t-28-68v-1344q0-40 28-68t68-28h1088q40 0 68 28t28 68v328q21 13 36 28l408 408q28 28 48 76t20 88z"},check:{viewbox:"0 0 1792 1792",path:"M249.2,431.2c-23,0-45.6,9.4-61.8,25.6L25.6,618.6C9.4,634.8,0,657.4,0,680.4c0,23,9.4,45.6,25.6,61.8 l593.1,593.1c16.2,16.2,38.8,25.6,61.8,25.6c23,0,45.6-9.4,61.8-25.6L1766.4,311c16.2-16.2,25.6-38.8,25.6-61.8 s-9.4-45.6-25.6-61.8L1604.5,25.6C1588.3,9.4,1565.8,0,1542.8,0c-23,0-45.6,9.4-61.8,25.6L680.4,827L311,456.3 C294.8,440.5,272.3,431.2,249.2,431.2z"},"angle-down":{viewbox:"0 0 1792 1792",path:"M1395 736q0 13-10 23l-466 466q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l393 393 393-393q10-10 23-10t23 10l50 50q10 10 10 23z"},"angle-left":{viewbox:"0 0 1792 1792",path:"M1203 544q0 13-10 23l-393 393 393 393q10 10 10 23t-10 23l-50 50q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l50 50q10 10 10 23z"},"angle-right":{viewbox:"0 0 1792 1792",path:"M1171 960q0 13-10 23l-466 466q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l393-393-393-393q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l466 466q10 10 10 23z"},"angle-up":{viewbox:"0 0 1792 1792",path:"M1395 1184q0 13-10 23l-50 50q-10 10-23 10t-23-10l-393-393-393 393q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l466 466q10 10 10 23z"},"arrow-down":{viewbox:"0 0 1792 1792",path:"M896 1791L120.91 448.5L1671.09 448.5z"},"arrow-left":{viewbox:"0 0 1792 1792",path:"M1343.5 1671.09L1 896L1343.5 120.91z"},"arrow-right":{viewbox:"0 0 1792 1792",path:"M1791 896L448.5 1671.09L448.5 120.91z"},"arrow-up":{viewbox:"0 0 1792 1792",path:"M1671.09 1343.5L120.91 1343.5L896 1z"},"caret-right":{viewbox:"0 0 192 512",path:"M 0 384.662 V 127.338 c 0 -17.818 21.543 -26.741 34.142 -14.142 l 128.662 128.662 c 7.81 7.81 7.81 20.474 0 28.284 L 34.142 398.804 C 21.543 411.404 0 402.48 0 384.662 Z"},circle:{viewbox:"0 0 1792 1792",path:"M1664 896q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"},desktop:{viewbox:"0 0 1792 1792",path:"M1728 992v-832q0-13-9.5-22.5t-22.5-9.5h-1600q-13 0-22.5 9.5t-9.5 22.5v832q0 13 9.5 22.5t22.5 9.5h1600q13 0 22.5-9.5t9.5-22.5zm128-832v1088q0 66-47 113t-113 47h-544q0 37 16 77.5t32 71 16 43.5q0 26-19 45t-45 19h-512q-26 0-45-19t-19-45q0-14 16-44t32-70 16-78h-544q-66 0-113-47t-47-113v-1088q0-66 47-113t113-47h1600q66 0 113 47t47 113z"},edit:{viewbox:"0 0 1792 1792",path:"M491 1536l91-91-235-235-91 91v107h128v128h107zm523-928q0-22-22-22-10 0-17 7l-542 542q-7 7-7 17 0 22 22 22 10 0 17-7l542-542q7-7 7-17zm-54-192l416 416-832 832h-416v-416zm683 96q0 53-37 90l-166 166-416-416 166-165q36-38 90-38 53 0 91 38l235 234q37 39 37 91z"},eye:{viewbox:"0 0 1792 1792",path:"M1664 960q-152-236-381-353 61 104 61 225 0 185-131.5 316.5t-316.5 131.5-316.5-131.5-131.5-316.5q0-121 61-225-229 117-381 353 133 205 333.5 326.5t434.5 121.5 434.5-121.5 333.5-326.5zm-720-384q0-20-14-34t-34-14q-125 0-214.5 89.5t-89.5 214.5q0 20 14 34t34 14 34-14 14-34q0-86 61-147t147-61q20 0 34-14t14-34zm848 384q0 34-20 69-140 230-376.5 368.5t-499.5 138.5-499.5-139-376.5-368q-20-35-20-69t20-69q140-229 376.5-368t499.5-139 499.5 139 376.5 368q20 35 20 69z"},"exclamation-triangle":{viewbox:"0 0 1792 1792",path:"M1024 1375v-190q0-14-9.5-23.5T992 1152H800q-13 0-22.5 9.5T768 1185v190q0 14 9.5 23.5t22.5 9.5h192q13 0 22.5-9.5t9.5-23.5zm-2-374l18-459q0-12-10-19-13-11-24-11H786q-11 0-24 11-10 7-10 21l17 457q0 10 10 16.5t24 6.5h185q14 0 23.5-6.5t10.5-16.5zm-14-934l768 1408q35 63-2 126-17 29-46.5 46t-63.5 17H128q-34 0-63.5-17T18 1601q-37-63-2-126L784 67q17-31 47-49t65-18 65 18 47 49z"},"file-text":{viewbox:"0 0 1792 1792",path:"M1596 380q28 28 48 76t20 88v1152q0 40-28 68t-68 28h-1344q-40 0-68-28t-28-68v-1600q0-40 28-68t68-28h896q40 0 88 20t76 48zm-444-244v376h376q-10-29-22-41l-313-313q-12-12-41-22zm384 1528v-1024h-416q-40 0-68-28t-28-68v-416h-768v1536h1280zm-1024-864q0-14 9-23t23-9h704q14 0 23 9t9 23v64q0 14-9 23t-23 9h-704q-14 0-23-9t-9-23v-64zm736 224q14 0 23 9t9 23v64q0 14-9 23t-23 9h-704q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h704zm0 256q14 0 23 9t9 23v64q0 14-9 23t-23 9h-704q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h704z"},gear:{viewbox:"0 0 1792 1792",path:"M1800 800h-218q-26 -107 -81 -193l154 -154l-210 -210l-154 154q-88 -55 -191 -79v-218h-300v218q-103 24 -191 79l-154 -154l-212 212l154 154q-55 88 -79 191h-218v297h217q23 101 80 194l-154 154l210 210l154 -154q85 54 193 81v218h300v-218q103 -24 191 -79 l154 154l212 -212l-154 -154q57 -93 80 -194h217v-297zM950 650q124 0 212 88t88 212t-88 212t-212 88t-212 -88t-88 -212t88 -212t212 -88z"},key:{viewbox:"0 0 1792 1792",path:"M832 512q0-80-56-136t-136-56-136 56-56 136q0 42 19 83-41-19-83-19-80 0-136 56t-56 136 56 136 136 56 136-56 56-136q0-42-19-83 41 19 83 19 80 0 136-56t56-136zm851 704q0 17-49 66t-66 49q-9 0-28.5-16t-36.5-33-38.5-40-24.5-26l-96 96 220 220q28 28 28 68 0 42-39 81t-81 39q-40 0-68-28l-671-671q-176 131-365 131-163 0-265.5-102.5t-102.5-265.5q0-160 95-313t248-248 313-95q163 0 265.5 102.5t102.5 265.5q0 189-131 365l355 355 96-96q-3-3-26-24.5t-40-38.5-33-36.5-16-28.5q0-17 49-66t66-49q13 0 23 10 6 6 46 44.5t82 79.5 86.5 86 73 78 28.5 41z"},list:{viewbox:"0 0 1792 1792",path:"M384 1408q0 80-56 136t-136 56-136-56-56-136 56-136 136-56 136 56 56 136zm0-512q0 80-56 136t-136 56-136-56-56-136 56-136 136-56 136 56 56 136zm1408 416v192q0 13-9.5 22.5t-22.5 9.5h-1216q-13 0-22.5-9.5t-9.5-22.5v-192q0-13 9.5-22.5t22.5-9.5h1216q13 0 22.5 9.5t9.5 22.5zm-1408-928q0 80-56 136t-136 56-136-56-56-136 56-136 136-56 136 56 56 136zm1408 416v192q0 13-9.5 22.5t-22.5 9.5h-1216q-13 0-22.5-9.5t-9.5-22.5v-192q0-13 9.5-22.5t22.5-9.5h1216q13 0 22.5 9.5t9.5 22.5zm0-512v192q0 13-9.5 22.5t-22.5 9.5h-1216q-13 0-22.5-9.5t-9.5-22.5v-192q0-13 9.5-22.5t22.5-9.5h1216q13 0 22.5 9.5t9.5 22.5z"},"loading-spinner":{viewbox:"0 0 66 66",CustomComponent:m,path:[Object(r.createElement)("circle",{key:"5",className:"path",fill:"none",strokeWidth:"6",strokeLinecap:"round",cx:"33",cy:"33",r:"30"})]},mobile:{viewbox:"0 0 1792 1792",path:"M976 1408q0-33-23.5-56.5t-56.5-23.5-56.5 23.5-23.5 56.5 23.5 56.5 56.5 23.5 56.5-23.5 23.5-56.5zm208-160v-704q0-13-9.5-22.5t-22.5-9.5h-512q-13 0-22.5 9.5t-9.5 22.5v704q0 13 9.5 22.5t22.5 9.5h512q13 0 22.5-9.5t9.5-22.5zm-192-848q0-16-16-16h-160q-16 0-16 16t16 16h160q16 0 16-16zm288-16v1024q0 52-38 90t-90 38h-512q-52 0-90-38t-38-90v-1024q0-52 38-90t90-38h512q52 0 90 38t38 90z"},"pencil-square":{viewbox:"0 0 1792 1792",path:"M888 1184l116-116-152-152-116 116v56h96v96h56zm440-720q-16-16-33 1l-350 350q-17 17-1 33t33-1l350-350q17-17 1-33zm80 594v190q0 119-84.5 203.5t-203.5 84.5h-832q-119 0-203.5-84.5t-84.5-203.5v-832q0-119 84.5-203.5t203.5-84.5h832q63 0 117 25 15 7 18 23 3 17-9 29l-49 49q-14 14-32 8-23-6-45-6h-832q-66 0-113 47t-47 113v832q0 66 47 113t113 47h832q66 0 113-47t47-113v-126q0-13 9-22l64-64q15-15 35-7t20 29zm-96-738l288 288-672 672h-288v-288zm444 132l-92 92-288-288 92-92q28-28 68-28t68 28l152 152q28 28 28 68t-28 68z"},plus:{viewbox:"0 0 1792 1792",path:"M1600 736v192q0 40-28 68t-68 28h-416v416q0 40-28 68t-68 28h-192q-40 0-68-28t-28-68v-416h-416q-40 0-68-28t-28-68v-192q0-40 28-68t68-28h416v-416q0-40 28-68t68-28h192q40 0 68 28t28 68v416h416q40 0 68 28t28 68z"},"plus-circle":{viewbox:"0 0 1792 1792",path:"M1344 960v-128q0-26-19-45t-45-19h-256v-256q0-26-19-45t-45-19h-128q-26 0-45 19t-19 45v256h-256q-26 0-45 19t-19 45v128q0 26 19 45t45 19h256v256q0 26 19 45t45 19h128q26 0 45-19t19-45v-256h256q26 0 45-19t19-45zm320-64q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"},"question-circle":{viewbox:"0 0 1792 1792",path:"M1024 1376v-192q0-14-9-23t-23-9h-192q-14 0-23 9t-9 23v192q0 14 9 23t23 9h192q14 0 23-9t9-23zm256-672q0-88-55.5-163t-138.5-116-170-41q-243 0-371 213-15 24 8 42l132 100q7 6 19 6 16 0 25-12 53-68 86-92 34-24 86-24 48 0 85.5 26t37.5 59q0 38-20 61t-68 45q-63 28-115.5 86.5t-52.5 125.5v36q0 14 9 23t23 9h192q14 0 23-9t9-23q0-19 21.5-49.5t54.5-49.5q32-18 49-28.5t46-35 44.5-48 28-60.5 12.5-81zm384 192q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"},search:{viewbox:"0 0 1792 1792",path:"M1216 832q0-185-131.5-316.5t-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5 316.5-131.5 131.5-316.5zm512 832q0 52-38 90t-90 38q-54 0-90-38l-343-342q-179 124-399 124-143 0-273.5-55.5t-225-150-150-225-55.5-273.5 55.5-273.5 150-225 225-150 273.5-55.5 273.5 55.5 225 150 150 225 55.5 273.5q0 220-124 399l343 343q37 37 37 90z"},"seo-score-bad":{viewbox:"0 0 496 512",path:"M248 8C111 8 0 119 0 256s111 248 248 248s248-111 248-248S385 8 248 8z M328 176c17.7 0 32 14.3 32 32 s-14.3 32-32 32s-32-14.3-32-32S310.3 176 328 176z M168 176c17.7 0 32 14.3 32 32s-14.3 32-32 32s-32-14.3-32-32S150.3 176 168 176 z M338.2 394.2C315.8 367.4 282.9 352 248 352s-67.8 15.4-90.2 42.2c-13.5 16.3-38.1-4.2-24.6-20.5C161.7 339.6 203.6 320 248 320 s86.3 19.6 114.7 53.8C376.3 390 351.7 410.5 338.2 394.2L338.2 394.2z"},"seo-score-good":{viewbox:"0 0 496 512",path:"M248 8C111 8 0 119 0 256s111 248 248 248s248-111 248-248S385 8 248 8z M328 176c17.7 0 32 14.3 32 32 s-14.3 32-32 32s-32-14.3-32-32S310.3 176 328 176z M168 176c17.7 0 32 14.3 32 32s-14.3 32-32 32s-32-14.3-32-32S150.3 176 168 176 z M362.8 346.2C334.3 380.4 292.5 400 248 400s-86.3-19.6-114.8-53.8c-13.6-16.3 11-36.7 24.6-20.5c22.4 26.9 55.2 42.2 90.2 42.2 s67.8-15.4 90.2-42.2C351.6 309.5 376.3 329.9 362.8 346.2L362.8 346.2z"},"seo-score-none":{viewbox:"0 0 496 512",path:"M248 8C111 8 0 119 0 256s111 248 248 248s248-111 248-248S385 8 248 8z"},"seo-score-ok":{viewbox:"0 0 496 512",path:"M248 8c137 0 248 111 248 248S385 504 248 504S0 393 0 256S111 8 248 8z M360 208c0-17.7-14.3-32-32-32 s-32 14.3-32 32s14.3 32 32 32S360 225.7 360 208z M344 368c21.2 0 21.2-32 0-32H152c-21.2 0-21.2 32 0 32H344z M200 208 c0-17.7-14.3-32-32-32s-32 14.3-32 32s14.3 32 32 32S200 225.7 200 208z"},times:{viewbox:"0 0 1792 1792",path:"M1490 1322q0 40-28 68l-136 136q-28 28-68 28t-68-28l-294-294-294 294q-28 28-68 28t-68-28l-136-136q-28-28-28-68t28-68l294-294-294-294q-28-28-28-68t28-68l136-136q28-28 68-28t68 28l294 294 294-294q28-28 68-28t68 28l136 136q28 28 28 68t-28 68l-294 294 294 294q28 28 28 68z"},"times-circle":{viewbox:"0 0 20 20",path:"M10 2c4.42 0 8 3.58 8 8s-3.58 8-8 8-8-3.58-8-8 3.58-8 8-8zm5 11l-3-3 3-3-2-2-3 3-3-3-2 2 3 3-3 3 2 2 3-3 3 3z"},"alert-info":{viewbox:"0 0 512 512",path:"M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 110c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z"},"alert-error":{viewbox:"0 0 512 512",path:"M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"},"alert-success":{viewbox:"0 0 512 512",path:"M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"},"alert-warning":{viewbox:"0 0 576 512",path:"M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z"},"chart-square-bar":{viewbox:"0 0 24 24",path:[Object(r.createElement)("path",{key:"1",fill:"#ffffff",stroke:"currentColor",strokeLinecap:"round",strokeLinejoin:"round",strokeWidth:"2",d:"M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"})]}};var y=Object(u.createSvgIconComponent)(g);const v=c()(h)`
	margin-left: ${Object(u.getDirectionalStyle)("0","20px")};
	padding: ${Object(u.getDirectionalStyle)("0","20px")};
`,x=c()(y)``,O=c()(b)`
	box-shadow: ${e=>e.hasPaperStyle?"0 1px 2px "+Object(d.rgba)(d.colors.$color_black,.2):"none"};
	background-color: ${e=>e.hasPaperStyle?d.colors.$color_white:"transparent"};
	padding-right: ${e=>e.hasPaperStyle?"20px":"0"};
	padding-left: ${e=>e.hasPaperStyle?"20px":"0"};
	padding-bottom: ${e=>e.headingText?"0":"10px"};
	padding-top: ${e=>e.headingText?"0":"10px"};

	*, & {
		box-sizing: border-box;

		&:before, &:after {
			box-sizing: border-box;
		}
	}

	& ${v} {
		display: flex;
		align-items: center;
		padding: 8px 0 0;
		font-size: 1rem;
		line-height: 1.5;
		margin: 0 0 16px;
		font-family: "Open Sans", sans-serif;
		font-weight: 300;
		color: ${e=>e.headingColor?e.headingColor:""+d.colors.$color_grey_dark};
	}

	& ${x} {
		flex: 0 0 auto;
		${Object(u.getDirectionalStyle)("margin-right","margin-left")}: 8px;
	}
`,C=e=>Object(r.createElement)(O,{className:e.className,headingColor:e.headingColor,hasPaperStyle:e.hasPaperStyle},e.headingText&&Object(r.createElement)(v,{level:e.headingLevel,className:e.headingClassName},e.headingIcon&&Object(r.createElement)(x,{icon:e.headingIcon,color:e.headingIconColor,size:e.headingIconSize}),e.headingText),e.children);C.propTypes={className:l.a.string,headingLevel:l.a.number,headingClassName:l.a.string,headingColor:l.a.string,headingIcon:l.a.string,headingIconColor:l.a.string,headingIconSize:l.a.string,headingText:l.a.string,hasPaperStyle:l.a.bool,children:l.a.any},C.defaultProps={className:"yoast-section",headingLevel:2,hasPaperStyle:!0};var w=C,_=o(107),j=o.n(_);function E(e){return c()(e)`
		display: inline-flex;
		align-items: center;
		justify-content: center;
		vertical-align: middle;
		border-width: ${"1px"};
		border-style: solid;
		margin: 0;
		padding: ${"4px"} 10px;
		border-radius: 3px;
		cursor: pointer;
		box-sizing: border-box;
		font-size: inherit;
		font-family: inherit;
		font-weight: inherit;
		text-align: ${Object(u.getDirectionalStyle)("left","right")};
		overflow: visible;
		min-height: ${"32px"};
		transition: var(--yoast-transition-default);

		svg {
			// Safari 10
			align-self: center;
		}

		// Only needed for IE 10+. Don't add spaces within brackets for this to work.
		@media all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
			::after {
				display: inline-block;
				content: "";
				min-height: ${"22px"};
			}
		}
	`}function k(e){return c()(e)`
		&::-moz-focus-inner {
			border-width: 0;
		}

		&:focus {
			outline: none;
			border-color: ${e=>e.focusBorderColor};
			color: ${e=>e.focusColor};
			background-color: ${e=>e.focusBackgroundColor};
			box-shadow: 0 0 3px ${e=>Object(d.rgba)(e.focusBoxShadowColor,.8)}
		}
	`}function S(e){return c()(e)`
		&:hover {
			color: ${e=>e.hoverColor};
			background-color: ${e=>e.hoverBackgroundColor};
			border-color: var(--yoast-color-border--default);
		}
	`}function T(e){return c()(e)`
		&:active {
			color: ${e=>e.activeColor};
			background-color: ${e=>e.activeBackgroundColor};
			border-color: ${e=>e.hoverBorderColor};
			box-shadow: inset 0 2px 5px -3px ${e=>Object(d.rgba)(e.activeBorderColor,.5)}
		}
	`}const $=j()([T,k,S,E]),q=$(c.a.button`
		color: ${e=>e.textColor};
		border-color: ${e=>e.borderColor};
		background: ${e=>e.backgroundColor};
		box-shadow: 0 1px 0 ${e=>Object(d.rgba)(e.boxShadowColor,1)};
	`);q.propTypes={type:l.a.string,backgroundColor:l.a.string,textColor:l.a.string,borderColor:l.a.string,boxShadowColor:l.a.string,hoverColor:l.a.string,hoverBackgroundColor:l.a.string,activeColor:l.a.string,activeBackgroundColor:l.a.string,activeBorderColor:l.a.string,focusColor:l.a.string,focusBackgroundColor:l.a.string,focusBorderColor:l.a.string,focusBoxShadowColor:l.a.string},q.defaultProps={type:"button",backgroundColor:d.colors.$color_button,textColor:d.colors.$color_button_text,borderColor:d.colors.$color_button_border,boxShadowColor:d.colors.$color_button_border,hoverColor:d.colors.$color_button_text_hover,hoverBackgroundColor:d.colors.$color_button_hover,activeColor:d.colors.$color_button_text_hover,activeBackgroundColor:d.colors.$color_button,activeBorderColor:d.colors.$color_button_border_active,focusColor:d.colors.$color_button_text_hover,focusBackgroundColor:d.colors.$color_white,focusBorderColor:d.colors.$color_blue,focusBoxShadowColor:d.colors.$color_blue_dark};var N=q;const R=$(c.a.a`
		text-decoration: none;
		color: ${e=>e.textColor};
		border-color: ${e=>e.borderColor};
		background: ${e=>e.backgroundColor};
		box-shadow: 0 1px 0 ${e=>Object(d.rgba)(e.boxShadowColor,1)};
	`);R.propTypes={backgroundColor:l.a.string,textColor:l.a.string,borderColor:l.a.string,boxShadowColor:l.a.string,hoverColor:l.a.string,hoverBackgroundColor:l.a.string,hoverBorderColor:l.a.string,activeColor:l.a.string,activeBackgroundColor:l.a.string,activeBorderColor:l.a.string,focusColor:l.a.string,focusBackgroundColor:l.a.string,focusBorderColor:l.a.string,focusBoxShadowColor:l.a.string},R.defaultProps={backgroundColor:d.colors.$color_button,textColor:d.colors.$color_button_text,borderColor:d.colors.$color_button_border,boxShadowColor:d.colors.$color_button_border,hoverColor:d.colors.$color_button_text_hover,hoverBackgroundColor:d.colors.$color_button_hover,hoverBorderColor:d.colors.$color_button_border_hover,activeColor:d.colors.$color_button_text_hover,activeBackgroundColor:d.colors.$color_button,activeBorderColor:d.colors.$color_button_border_hover,focusColor:d.colors.$color_button_text_hover,focusBackgroundColor:d.colors.$color_white,focusBorderColor:d.colors.$color_blue,focusBoxShadowColor:d.colors.$color_blue_dark};var P=o(12),B=o.n(P);const I="yoast-button yoast-button--",z={buy:{iconAfter:"yoast-button--buy__caret"},edit:{iconBefore:"yoast-button--edit"},upsell:{iconAfter:"yoast-button--buy__caret"}},M={primary:I+"primary",secondary:I+"secondary",buy:I+"buy",hide:"yoast-hide",remove:"yoast-remove",upsell:I+"buy",purple:I+"primary",grey:I+"secondary",yellow:I+"buy",edit:I+"primary"},L=(e,t)=>{let o=M[e];return t&&(o+=" yoast-button--small"),o},D=e=>z[e]||null,A=e=>{const{children:t,className:o,variant:n,small:a,type:s,buttonRef:l,...i}=e,c=D(n),d=c&&c.iconBefore,u=c&&c.iconAfter;return Object(r.createElement)("button",B()({ref:l,className:o||L(n,a),type:s},i),!!d&&Object(r.createElement)("span",{className:d}),t,!!u&&Object(r.createElement)("span",{className:u}))};A.propTypes={onClick:l.a.func,type:l.a.string,className:l.a.string,buttonRef:l.a.object,small:l.a.bool,variant:l.a.oneOf(Object.keys(M)),children:l.a.oneOfType([l.a.node,l.a.arrayOf(l.a.node)])},A.defaultProps={className:"",type:"button",variant:"primary",small:!1,children:null,onClick:null,buttonRef:null};const F=e=>{const{children:t,className:o,variant:n,small:a,buttonRef:s,...l}=e,i=D(n),c=i&&i.iconBefore,d=i&&i.iconAfter;return Object(r.createElement)("a",B()({className:o||L(n,a),ref:s},l),!!c&&Object(r.createElement)("span",{className:c}),t,!!d&&Object(r.createElement)("span",{className:d}))};F.propTypes={href:l.a.string.isRequired,variant:l.a.oneOf(Object.keys(M)),small:l.a.bool,className:l.a.string,buttonRef:l.a.object,children:l.a.oneOfType([l.a.node,l.a.arrayOf(l.a.node)])},F.defaultProps={className:"",variant:"primary",small:!1,children:null,buttonRef:null};var U=o(4);const H=Object(r.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 352 512",role:"img","aria-hidden":"true",focusable:"false"},Object(r.createElement)("path",{d:"M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"})),W=e=>Object(r.createElement)("button",B()({className:"yoast-close","aria-label":Object(U.__)("Close","wordpress-seo")},e),H);W.propTypes={onClick:l.a.func.isRequired};const V={linkTo:l.a.string,linkText:l.a.string},K={linkTo:"",linkText:""},G=e=>{let{linkTo:t,linkText:o}=e;return Object(r.createElement)("a",{className:"yoast-help",target:"_blank",href:t,rel:"noopener noreferrer"},Object(r.createElement)("span",{className:"yoast-help__icon"},Object(r.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 12 12",role:"img","aria-hidden":"true",focusable:"false"},Object(r.createElement)("path",{d:"M12 6A6 6 0 110 6a6 6 0 0112 0zM6.2 2C4.8 2 4 2.5 3.3 3.5l.1.4.8.7.4-.1c.5-.5.8-.9 1.4-.9.5 0 1.1.4 1.1.8s-.3.6-.7.9C5.8 5.6 5 6 5 7c0 .2.2.4.3.4h1.4L7 7c0-.8 2-.8 2-2.6C9 3 7.5 2 6.2 2zM6 8a1.1 1.1 0 100 2.2A1.1 1.1 0 006 8z"}))),Object(r.createElement)("span",{className:"screen-reader-text"},Object(U.__)(o,"wordpress-seo")),Object(r.createElement)("span",{className:"screen-reader-text"},Object(U.__)("(Opens in a new browser tab)","wordpress-seo")))};G.propTypes=V,G.defaultProps=K;var Y=G;const Z=e=>{let{inLabel:t}=e;return Object(r.createElement)("span",{className:t?"yoast-badge yoast-badge__in-label yoast-new-badge":"yoast-badge yoast-new-badge"},Object(U.__)("New","wordpress-seo"))};Z.propTypes={inLabel:l.a.bool},Z.defaultProps={inLabel:!1};var X=Z;const J=e=>{let{inLabel:t}=e;return Object(r.createElement)("span",{className:t?"yoast-badge yoast-badge__in-label yoast-premium-badge":"yoast-badge yoast-premium-badge"},"Premium")};J.propTypes={inLabel:l.a.bool},J.defaultProps={inLabel:!1};var Q=J;const ee=e=>{let{htmlFor:t,label:o,linkTo:n,linkText:a,description:s,children:l,wrapperClassName:i,titleClassName:c,hasNewBadge:d,hasPremiumBadge:u}=e;const p=t?Object(r.createElement)("label",{htmlFor:t},o):Object(r.createElement)("b",null,o);return Object(r.createElement)("div",{className:i},""!==o&&Object(r.createElement)("div",{className:c},p,u&&Object(r.createElement)(Q,{inLabel:!0}),d&&Object(r.createElement)(X,{inLabel:!0}),""!==n&&Object(r.createElement)(Y,{linkTo:n,linkText:a})),""!==s&&Object(r.createElement)("p",{className:"field-group-description"},s),l)},te={label:l.a.string,description:l.a.string,children:l.a.oneOfType([l.a.node,l.a.arrayOf(l.a.node)]),wrapperClassName:l.a.string,titleClassName:l.a.string,htmlFor:l.a.string,...V},oe={label:"",description:"",children:[],wrapperClassName:"yoast-field-group",titleClassName:"yoast-field-group__title",htmlFor:"",...K};ee.propTypes=te,ee.defaultProps=oe;var re=ee;function ne(e){const t=Object(n.useCallback)(t=>{e.onChange(t.target.value)},[e.onChange]);return Object(r.createElement)(re,{wrapperClassName:"yoast-field-group yoast-field-group__checkbox"},Object(r.createElement)("input",{type:"checkbox",id:e.id,checked:e.checked,onChange:t}),Object(r.createElement)("label",{htmlFor:e.id},e.label))}ne.propTypes={id:l.a.string.isRequired,label:l.a.oneOfType([l.a.string,l.a.arrayOf(l.a.node),l.a.node]).isRequired,checked:l.a.bool,onChange:l.a.func.isRequired},ne.defaultProps={checked:!1};const ae={width:l.a.number.isRequired,name:l.a.string.isRequired,number:l.a.number.isRequired},se=e=>{
/* Translators: %d expands to number of occurrences. */
const t=Object(U.sprintf)(Object(U.__)("%d occurrences","wordpress-seo"),e.number);return Object(r.createElement)("li",{key:e.name+"_dataItem",style:{"--yoast-width":e.width+"%"}},e.name,Object(r.createElement)("span",null,e.number),Object(r.createElement)("span",{className:"screen-reader-text"},t))};se.propTypes=ae;const le=e=>Object(r.createElement)("ul",{className:"yoast-data-model","aria-label":Object(U.__)("Prominent words","wordpress-seo")},e.items.map(se));le.propTypes={items:l.a.arrayOf(l.a.shape(ae))},le.defaultProps={items:[]};var ie=le;const ce=e=>{const{imageSelected:t,onClick:o,onRemoveImageClick:n,selectImageButtonId:a,replaceImageButtonId:s,removeImageButtonId:l,isDisabled:i}=e,c=Object(r.useCallback)(e=>{e.target.previousElementSibling.focus(),n()},[n]);return Object(r.createElement)("div",{className:"yoast-image-select-buttons"},Object(r.createElement)(A,{variant:"secondary",id:t?s:a,onClick:o,disabled:i},t?Object(U.__)("Replace image","wordpress-seo"):Object(U.__)("Select image","wordpress-seo")),t&&Object(r.createElement)(A,{variant:"remove",id:l,onClick:c,disabled:i},Object(U.__)("Remove image","wordpress-seo")))};var de=ce;ce.propTypes={imageSelected:l.a.bool,onClick:l.a.func,onRemoveImageClick:l.a.func,selectImageButtonId:l.a.string,replaceImageButtonId:l.a.string,removeImageButtonId:l.a.string,isDisabled:l.a.bool},ce.defaultProps={imageSelected:!1,onClick:()=>{},onRemoveImageClick:()=>{},selectImageButtonId:"",replaceImageButtonId:"",removeImageButtonId:"",isDisabled:!1};const ue=c.a.div`
	display: flex;
	align-items: flex-start;
	font-size: 13px;
	line-height: 1.5;
	border: 1px solid rgba(0, 0, 0, 0.2);
	padding: 16px;
	color: ${e=>e.alertColor};
	background: ${e=>e.alertBackground};
	margin-bottom: 20px;
`,pe=c.a.div`
	flex-grow: 1;

	a {
		color: ${d.colors.$color_alert_link_text};
	}

	p {
		margin-top: 0;
	}
`,he=c()(y)`
	margin-top: 0.1rem;
	${Object(u.getDirectionalStyle)("margin-right: 8px","margin-left: 8px")};
`,fe=c()(N)`
	${Object(u.getDirectionalStyle)("margin: -8px -12px -8px 8px","margin: -8px 8px -12px -8px")};
	font-size: 24px;
	line-height: 1.4;
	color: ${e=>e.alertDismissColor};
	flex-shrink: 0;
	min-width: 36px;
	height: 36px;

	// Override the base button style: get rid of the button styling.
	padding: 0;

	&, &:hover, &:active {
		/* Inherits box-sizing: border-box so this doesn't change the rendered size. */
		border: 2px solid transparent;
		background: transparent;
		box-shadow: none;
		color: ${e=>e.alertDismissColor};
	}

	/* Inherits focus style from the Button component. */
	&:focus {
		background: transparent;
		color: ${e=>e.alertDismissColor};
		border-color: ${d.colors.$color_yoast_focus};
		box-shadow: 0px 0px 0px 3px ${d.colors.$color_yoast_focus_outer};
	}
`;class be extends a.a.Component{getTypeDisplayOptions(e){switch(e){case"error":return{color:d.colors.$color_alert_error_text,background:d.colors.$color_alert_error_background,icon:"alert-error"};case"info":return{color:d.colors.$color_alert_info_text,background:d.colors.$color_alert_info_background,icon:"alert-info"};case"success":return{color:d.colors.$color_alert_success_text,background:d.colors.$color_alert_success_background,icon:"alert-success"};case"warning":return{color:d.colors.$color_alert_warning_text,background:d.colors.$color_alert_warning_background,icon:"alert-warning"}}}render(){if(!0===this.props.isAlertDismissed)return null;const e=this.getTypeDisplayOptions(this.props.type),t=this.props.dismissAriaLabel||Object(U.__)("Dismiss this alert","wordpress-seo");return Object(r.createElement)(ue,{alertColor:e.color,alertBackground:e.background,className:this.props.className},Object(r.createElement)(he,{icon:e.icon,color:e.color}),Object(r.createElement)(pe,null,this.props.children),"function"==typeof this.props.onDismissed?Object(r.createElement)(fe,{alertDismissColor:e.color,onClick:this.props.onDismissed,"aria-label":t},"×"):null)}}be.propTypes={children:l.a.any.isRequired,type:l.a.oneOf(["error","info","success","warning"]).isRequired,onDismissed:l.a.func,isAlertDismissed:l.a.bool,dismissAriaLabel:l.a.string,className:l.a.string},be.defaultProps={onDismissed:null,isAlertDismissed:!1,dismissAriaLabel:"",className:""};var me=be;function ge(e){const t=!1===e.usingFallback&&""!==e.imageUrl,o=e.imageUrl||e.defaultImageUrl||"",n=e.warnings.length>0&&t;let a=n?"yoast-image-select__preview yoast-image-select__preview-has-warnings":"yoast-image-select__preview";""===o&&(a="yoast-image-select__preview yoast-image-select__preview--no-preview");const s={imageSelected:t,onClick:e.onClick,onRemoveImageClick:e.onRemoveImageClick,selectImageButtonId:e.selectImageButtonId,replaceImageButtonId:e.replaceImageButtonId,removeImageButtonId:e.removeImageButtonId,isDisabled:e.isDisabled};return Object(r.createElement)("div",{className:"yoast-image-select",onMouseEnter:e.onMouseEnter,onMouseLeave:e.onMouseLeave},Object(r.createElement)(re,{label:e.label,hasNewBadge:e.hasNewBadge,hasPremiumBadge:e.hasPremiumBadge},e.hasPreview&&Object(r.createElement)("button",{className:a,onClick:e.onClick,type:"button",disabled:e.isDisabled},""!==o&&Object(r.createElement)("img",{src:o,alt:e.imageAltText,className:"yoast-image-select__preview--image"}),Object(r.createElement)(()=>Object(r.createElement)("span",{className:"screen-reader-text"},t?Object(U.__)("Replace image","wordpress-seo"):Object(U.__)("Select image","wordpress-seo")),null)),n&&Object(r.createElement)("div",{role:"alert"},e.warnings.map((e,t)=>Object(r.createElement)(me,{key:"warning"+t,type:"warning"},e))),Object(r.createElement)(de,s)))}var ye=ge;ge.propTypes={defaultImageUrl:l.a.string,imageUrl:l.a.string,imageAltText:l.a.string,hasPreview:l.a.bool.isRequired,label:l.a.string.isRequired,onClick:l.a.func,onMouseEnter:l.a.func,onMouseLeave:l.a.func,onRemoveImageClick:l.a.func,selectImageButtonId:l.a.string,replaceImageButtonId:l.a.string,removeImageButtonId:l.a.string,warnings:l.a.arrayOf(l.a.string),hasNewBadge:l.a.bool,isDisabled:l.a.bool,usingFallback:l.a.bool,hasPremiumBadge:l.a.bool},ge.defaultProps={defaultImageUrl:"",imageUrl:"",imageAltText:"",onClick:()=>{},onMouseEnter:()=>{},onMouseLeave:()=>{},onRemoveImageClick:()=>{},selectImageButtonId:"",replaceImageButtonId:"",removeImageButtonId:"",warnings:[],hasNewBadge:!1,isDisabled:!1,usingFallback:!1,hasPremiumBadge:!1};const ve=e=>{const t={...e};return e.id&&(t.htmlFor=e.id),Object(r.createElement)(re,t,Object(r.createElement)("input",{id:e.id,name:e.name,value:e.value,type:e.type,className:"yoast-field-group__inputfield","aria-describedby":e.ariaDescribedBy,placeholder:e.placeholder,readOnly:e.readOnly,min:e.min,max:e.max,step:e.step,onChange:(o=e.onChange,e=>{o(e.target.value)})}));var o};ve.propTypes={id:l.a.string,name:l.a.string,value:l.a.string,type:l.a.oneOf(["text","color","date","datetime-local","email","hidden","month","number","password","search","tel","time","url","week","range"]),ariaDescribedBy:l.a.string,placeholder:l.a.string,readOnly:l.a.bool,min:l.a.number,max:l.a.number,step:l.a.number,onChange:l.a.func,...te},ve.defaultProps={id:"",name:"",value:"",ariaDescribedBy:"",readOnly:!1,type:"text",placeholder:void 0,min:void 0,max:void 0,step:void 0,onChange:void 0,...oe};var xe=ve,Oe=o(2);function Ce(e){return{hours:Math.floor(e/3600),minutes:Math.floor(e%3600/60),seconds:e%3600%60}}class we extends a.a.Component{constructor(e){super(e),this.state={...Ce(e.duration)},this.onHoursChange=this.onHoursChange.bind(this),this.onMinutesChange=this.onMinutesChange.bind(this),this.onSecondsChange=this.onSecondsChange.bind(this)}formatValue(e){let t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:Number.MIN_VALUE,o=arguments.length>2&&void 0!==arguments[2]?arguments[2]:Number.MAX_VALUE;const r=parseInt(e.target.value,10)||0;return Object(Oe.clamp)(r,t,o)}onHoursChange(e){this.props.onChange(3600*this.formatValue(e,0)+60*this.state.minutes+this.state.seconds)}onMinutesChange(e){this.props.onChange(3600*this.state.hours+60*this.formatValue(e,0,59)+this.state.seconds)}onSecondsChange(e){this.props.onChange(3600*this.state.hours+60*this.state.minutes+this.formatValue(e,0,59))}static getDerivedStateFromProps(e,t){const o=Ce(e.duration);return Object(Oe.isEqual)(o,t)?null:{...o}}render(){const e=this.props,t=e.id;return Object(r.createElement)(re,e,Object(r.createElement)("div",{className:"duration-inputs__wrapper"},Object(r.createElement)("div",{className:"duration-inputs__input-wrapper"},Object(r.createElement)("label",{htmlFor:t+"-hours"},Object(U.__)("hours","wordpress-seo")),Object(r.createElement)("input",{id:t+"-hours",name:"hours",value:this.state.hours,type:"number",className:"yoast-field-group__inputfield duration-inputs__input","aria-describedby":e.hoursAriaDescribedBy,readOnly:e.readOnly,min:0,onChange:this.onHoursChange})),Object(r.createElement)("div",{className:"duration-inputs__input-wrapper"},Object(r.createElement)("label",{htmlFor:t+"-minutes"},Object(U.__)("minutes","wordpress-seo")),Object(r.createElement)("input",{id:t+"-minutes",name:"minutes",value:this.state.minutes,type:"number",className:"yoast-field-group__inputfield duration-inputs__input","aria-describedby":e.minutesAriaDescribedBy,readOnly:e.readOnly,min:0,max:59,onChange:this.onMinutesChange})),Object(r.createElement)("div",{className:"duration-inputs__input-wrapper"},Object(r.createElement)("label",{htmlFor:t+"-seconds"},Object(U.__)("seconds","wordpress-seo")),Object(r.createElement)("input",{id:t+"-seconds",name:"seconds",value:this.state.seconds,type:"number",className:"yoast-field-group__inputfield duration-inputs__input","aria-describedby":e.secondsAriaDescribedBy,readOnly:e.readOnly,min:0,max:59,onChange:this.onSecondsChange}))))}}we.propTypes={duration:l.a.number.isRequired,hoursAriaDescribedBy:l.a.string,minutesAriaDescribedBy:l.a.string,secondsAriaDescribedBy:l.a.string,id:l.a.string.isRequired,...te},we.defaultProps={hoursAriaDescribedBy:"",minutesAriaDescribedBy:"",secondsAriaDescribedBy:"",...oe};var _e=we;class je extends a.a.Component{getInsightsCardContent(){return Object(r.createElement)("div",{className:"yoast-insights-card__content"},Object(r.createElement)("p",{className:"yoast-insights-card__score"},Object(r.createElement)("span",{className:"yoast-insights-card__amount"},this.props.amount),this.props.unit),this.props.description&&Object(r.createElement)("div",{className:"yoast-insights-card__description"},this.props.description))}render(){return Object(r.createElement)(re,{label:this.props.title,linkTo:this.props.linkTo,linkText:this.props.linkText,wrapperClassName:"yoast-insights-card"},this.getInsightsCardContent())}}var Ee=je;je.propTypes={title:l.a.string,amount:l.a.oneOfType([l.a.number,l.a.oneOf(["?"])]).isRequired,description:l.a.element,unit:l.a.string,linkTo:l.a.string,linkText:l.a.string},je.defaultProps={title:"",description:null,unit:"",linkTo:"",linkText:""};const ke={options:l.a.array.isRequired,onChange:l.a.func.isRequired,groupName:l.a.string.isRequired,id:l.a.string.isRequired,selected:l.a.oneOfType([l.a.string,l.a.number])},Se={selected:null},Te=e=>{let{value:t,label:o,checked:a,onChange:s,groupName:l,id:i}=e;return Object(r.createElement)(n.Fragment,null,Object(r.createElement)("input",{type:"radio",name:l,id:i,value:t,onChange:s,checked:a}),Object(r.createElement)("label",{htmlFor:i},o))};Te.propTypes={value:l.a.oneOfType([l.a.string,l.a.number]).isRequired,label:l.a.string.isRequired,checked:l.a.bool,groupName:l.a.string.isRequired,onChange:l.a.func,id:l.a.string.isRequired},Te.defaultProps={checked:!1,onChange:Oe.noop};const $e=e=>{let{options:t,onChange:o,groupName:n,id:a,selected:s}=e;return Object(r.createElement)("div",{className:"yoast-field-group__radiobutton"},t.map(e=>Object(r.createElement)(Te,B()({key:e.value,groupName:n,checked:s===e.value,onChange:o,id:`${a}_${e.value}`},e))))};$e.propTypes=ke,$e.defaultProps=Se;const qe=e=>{let{options:t,onChange:o,groupName:n,id:a,selected:s}=e;return Object(r.createElement)("div",{onChange:o},t.map(e=>Object(r.createElement)("div",{className:"yoast-field-group__radiobutton yoast-field-group__radiobutton--vertical",key:e.value},Object(r.createElement)(Te,B()({groupName:n,checked:s===e.value,id:`${a}_${e.value}`},e)))))};qe.propTypes=ke,qe.defaultProps=Se;const Ne=e=>{const{id:t,options:o,groupName:n,onChange:a,vertical:s,selected:l,...i}=e,c={options:o,groupName:n,selected:l,onChange:e=>a(e.target.value),id:(e=>e||Math.random().toString(36).substr(2,6))(t)};return Object(r.createElement)(re,i,s?Object(r.createElement)(qe,c):Object(r.createElement)($e,c))};Ne.propTypes={id:l.a.string,groupName:l.a.string.isRequired,options:l.a.arrayOf(l.a.shape({value:l.a.oneOfType([l.a.string,l.a.number]).isRequired,label:l.a.string.isRequired})).isRequired,selected:l.a.oneOfType([l.a.string,l.a.number]),onChange:l.a.func,vertical:l.a.bool,...te},Ne.defaultProps={id:"",vertical:!1,selected:null,onChange:()=>{},...oe};var Re=Ne,Pe=o(219),Be=o.n(Pe);const Ie=l.a.shape({name:l.a.string,value:l.a.string}),ze={id:l.a.string.isRequired,name:l.a.string,options:l.a.arrayOf(Ie).isRequired,selected:l.a.oneOfType([l.a.arrayOf(l.a.string),l.a.string]),onChange:l.a.func,...te},Me={name:"",selected:[],onChange:()=>{},...oe},Le=e=>{let{name:t,value:o}=e;return Object(r.createElement)("option",{key:o,value:o},t)};Le.propTypes={name:l.a.string.isRequired,value:l.a.string.isRequired};const De=e=>{const{id:t,isMulti:o,isSearchable:n,inputId:a,selected:s,options:l,name:i,onChange:c,...d}=e,u=Array.isArray(s)?s:[s],p=(e=>e.map(e=>({value:e.value,label:e.name})))(l),h=p.filter(e=>u.includes(e.value));return Object(r.createElement)(re,B()({},d,{htmlFor:a}),Object(r.createElement)(Be.a,{isMulti:o,id:t,name:i,inputId:a,value:h,options:p,hideSelectedOptions:!1,onChange:c,className:"yoast-select-container",classNamePrefix:"yoast-select",isClearable:!1,isSearchable:n,placeholder:""}))};De.propTypes=ze,De.defaultProps=Me;const Ae=e=>{const{onChange:t}=e,o=Object(n.useCallback)(e=>t(e.value));return Object(r.createElement)(De,B()({},e,{isMulti:!1,isSearchable:!0,onChange:o}))};Ae.propTypes=ze,Ae.defaultProps=Me;const Fe=e=>{const{onChange:t}=e,o=Object(n.useCallback)(e=>{e||(e=[]),t(e.map(e=>e.value))});return Object(r.createElement)(De,B()({},e,{isMulti:!0,isSearchable:!1,onChange:o}))};Fe.propTypes=ze,Fe.defaultProps=Me;class Ue extends a.a.Component{constructor(e){super(e),this.onBlurHandler=this.onBlurHandler.bind(this),this.onInputHandler=this.onInputHandler.bind(this),this.state={selected:this.props.selected}}onBlurHandler(e){this.props.onChange(e.target.value)}onInputHandler(e){this.setState({selected:e.target.value}),this.props.onOptionFocus&&this.props.onOptionFocus(e.target.name,e.target.value)}componentDidUpdate(e){e.selected!==this.props.selected&&this.setState({selected:this.props.selected})}render(){const{id:e,options:t,name:o,...n}=this.props;return Object(r.createElement)(re,B()({},n,{htmlFor:e}),Object(r.createElement)("select",{id:e,name:o,value:this.state.selected,onBlur:this.onBlurHandler,onInput:this.onInputHandler,onChange:Oe.noop},t.map(Le)))}}function He(e){let t=e.rating;t<0&&(t=0),t>5&&(t=5);const o=20*t;return Object(r.createElement)("div",{"aria-hidden":"true",className:"yoast-star-rating"},Object(r.createElement)("span",{className:"yoast-star-rating__placeholder",role:"img"},Object(r.createElement)("span",{className:"yoast-star-rating__fill",style:{width:o+"%"}})))}Ue.propTypes={...ze,onOptionFocus:l.a.func},Ue.defaultProps={...Me,onOptionFocus:null};var We=He;He.propTypes={rating:l.a.number.isRequired};var Ve=()=>Object(r.createElement)("span",{className:"yoast-badge yoast-beta-badge"},Object(U.__)("Beta","wordpress-seo"));const Ke=e=>{const{children:t,className:o,prefixIcon:n,suffixIcon:a,...s}=e;return Object(r.createElement)(N,B()({className:o},s),n&&n.icon&&Object(r.createElement)(y,{icon:n.icon,color:n.color,size:n.size}),t,a&&a.icon&&Object(r.createElement)(y,{icon:a.icon,color:a.color,size:a.size}))};Ke.propTypes={className:l.a.string,prefixIcon:l.a.shape({icon:l.a.string,color:l.a.string,size:l.a.string}),suffixIcon:l.a.shape({icon:l.a.string,color:l.a.string,size:l.a.string}),children:l.a.oneOfType([l.a.arrayOf(l.a.node),l.a.node,l.a.string])};var Ge=Ke,Ye={ScreenReaderText:{default:{clip:"rect(1px, 1px, 1px, 1px)",position:"absolute",height:"1px",width:"1px",overflow:"hidden"},focused:{clip:"auto",display:"block",left:"5px",top:"5px",height:"auto",width:"auto",zIndex:"100000",position:"absolute",backgroundColor:"#eeeeee ",padding:"10px"}}};const Ze=e=>Object(r.createElement)("span",{className:"screen-reader-text",style:Ye.ScreenReaderText.default},e.children);Ze.propTypes={children:l.a.string.isRequired};var Xe=Ze;const Je=c.a.span`
	flex-grow: 1;
	overflow-x: hidden;
	line-height: normal; // Avoid vertical scrollbar in IE 11 when rendered in the WP sidebar.
`,Qe=c.a.span`
	display: block;
	white-space: nowrap;
	text-overflow: ellipsis;
	overflow: hidden;
	color: ${d.colors.$color_headings};
`,et=c.a.span`
	display: block;
	white-space: nowrap;
	text-overflow: ellipsis;
	overflow: hidden;
	font-size: 0.8125rem;
	margin-top: 2px;
`,tt=e=>Object(r.createElement)(Je,null,Object(r.createElement)(Qe,null,e.title,e.titleScreenReaderText&&Object(r.createElement)(Xe,null," "+e.titleScreenReaderText)),e.subTitle&&Object(r.createElement)(et,null,e.subTitle));tt.propTypes={title:l.a.string.isRequired,titleScreenReaderText:l.a.string,subTitle:l.a.string};const ot=c.a.div`
	padding: 0 16px;
	margin-bottom: 16px;
`,rt=c.a.div`
	background-color: ${d.colors.$color_white};
`,nt=c()(rt)`
	border-top: var(--yoast-border-default);
`,at=c()(Ge)`
	width: 100%;
	background-color: ${d.colors.$color_white};
	padding: 16px;
	justify-content: flex-start;
	border-color: transparent;
	border: none;
	border-radius: 0;
	box-shadow: none;
	font-weight: normal;

	:focus {
		outline: 1px solid ${d.colors.$color_blue};
		outline-offset: -1px;
	}

	:active {
		box-shadow: none;
		background-color: ${d.colors.$color_white};
	}

	svg {
		${e=>e.hasSubTitle?"align-self: flex-start;":""}
		&:first-child {
			${Object(u.getDirectionalStyle)("margin-right: 8px","margin-left: 8px")};
		}
		&:last-child {
			${Object(u.getDirectionalStyle)("margin-left: 8px","margin-right: 8px")};
		}
	}
`;function st(e,t){const o="h"+t.level,n=c()(o)`
		margin: 0 !important;
		padding: 0 !important;
		font-size: ${t.fontSize} !important;
		font-weight: ${t.fontWeight} !important;
	`;return function(t){return Object(r.createElement)(n,null,Object(r.createElement)(e,t))}}const lt=st(at,{level:2,fontSize:"1rem",fontWeight:"normal"});function it(e){const{children:t,className:o,hasPadding:n,hasSeparator:a,Heading:s,id:l,isOpen:i,onToggle:c,prefixIcon:d,prefixIconCollapsed:u,suffixIcon:p,suffixIconCollapsed:h,subTitle:f,title:b,titleScreenReaderText:m}=e;let g=t;i&&n&&(g=Object(r.createElement)(ot,{className:"collapsible_content"},t));const y=a?nt:rt;return Object(r.createElement)(y,{className:o},Object(r.createElement)(s,{id:l,"aria-expanded":i,onClick:c,prefixIcon:i?d:u,suffixIcon:i?p:h,hasSubTitle:!!f},Object(r.createElement)(tt,{title:b,titleScreenReaderText:m,subTitle:f})),g)}it.propTypes={children:l.a.oneOfType([l.a.arrayOf(l.a.node),l.a.node]),className:l.a.string,Heading:l.a.func,isOpen:l.a.bool.isRequired,hasSeparator:l.a.bool,hasPadding:l.a.bool,onToggle:l.a.func.isRequired,prefixIcon:l.a.shape({icon:l.a.string,color:l.a.string,size:l.a.string}),prefixIconCollapsed:l.a.shape({icon:l.a.string,color:l.a.string,size:l.a.string}),subTitle:l.a.string,suffixIcon:l.a.shape({icon:l.a.string,color:l.a.string,size:l.a.string}),suffixIconCollapsed:l.a.shape({icon:l.a.string,color:l.a.string,size:l.a.string}),title:l.a.string.isRequired,titleScreenReaderText:l.a.string,id:l.a.string},it.defaultProps={Heading:lt,id:null,children:null,className:null,subTitle:null,titleScreenReaderText:null,hasSeparator:!1,hasPadding:!1,prefixIcon:null,prefixIconCollapsed:null,suffixIcon:null,suffixIconCollapsed:null};class ct extends a.a.Component{constructor(e){super(e),this.state={isOpen:e.initialIsOpen,headingProps:e.headingProps,Heading:st(at,e.headingProps)},this.toggleCollapse=this.toggleCollapse.bind(this)}static getDerivedStateFromProps(e,t){return e.headingProps.level!==t.headingProps.level||e.headingProps.fontSize!==t.headingProps.fontSize||e.headingProps.fontWeight!==t.headingProps.fontWeight?{...t,headingProps:e.headingProps,Heading:st(at,e.headingProps)}:null}toggleCollapse(){const{isOpen:e}=this.state,{onToggle:t}=this.props;t&&!1===t(e)||this.setState({isOpen:!e})}render(){const{isOpen:e}=this.state,{children:t}=this.props,o=Object(Oe.omit)(this.props,["children","onToggle"]);return Object(r.createElement)(it,B()({Heading:this.state.Heading,isOpen:e,onToggle:this.toggleCollapse},o),e&&t)}}ct.propTypes={children:l.a.oneOfType([l.a.arrayOf(l.a.node),l.a.node]),className:l.a.string,initialIsOpen:l.a.bool,hasSeparator:l.a.bool,hasPadding:l.a.bool,prefixIcon:l.a.shape({icon:l.a.string,color:l.a.string,size:l.a.string}),prefixIconCollapsed:l.a.shape({icon:l.a.string,color:l.a.string,size:l.a.string}),suffixIcon:l.a.shape({icon:l.a.string,color:l.a.string,size:l.a.string}),suffixIconCollapsed:l.a.shape({icon:l.a.string,color:l.a.string,size:l.a.string}),title:l.a.string.isRequired,titleScreenReaderText:l.a.string,subTitle:l.a.string,headingProps:l.a.shape({level:l.a.number,fontSize:l.a.string,fontWeight:l.a.string}),onToggle:l.a.func},ct.defaultProps={hasSeparator:!1,hasPadding:!1,initialIsOpen:!1,subTitle:null,titleScreenReaderText:null,children:null,className:null,prefixIcon:null,prefixIconCollapsed:null,suffixIcon:{icon:"chevron-up",color:d.colors.$black,size:"24px"},suffixIconCollapsed:{icon:"chevron-down",color:d.colors.$black,size:"24px"},headingProps:{level:2,fontSize:"1rem",fontWeight:"normal"},onToggle:null};var dt=ct;const ut=c.a.div`
	box-sizing: border-box;

	p {
		margin: 0;
		font-size: 14px;
	}
`,pt=c.a.h3`
	margin: 8px 0;
	font-size: 1em;
`,ht=c.a.ul`
	margin: 0;
	list-style: none;
	padding: 0;
`,ft=Object(u.makeOutboundLink)(c.a.a`
	display: inline-block;
	margin-bottom: 4px;
	font-size: 14px;
`),bt=c.a.li`
	margin: 8px 0;
`,mt=c.a.div`
	a {
		margin: 8px 0 0;
	}
`,gt=e=>Object(r.createElement)(bt,{className:e.className},Object(r.createElement)(ft,{className:e.className+"-link",href:e.link},e.title),Object(r.createElement)("p",{className:e.className+"-description"},e.description));gt.propTypes={className:l.a.string.isRequired,title:l.a.string.isRequired,link:l.a.string.isRequired,description:l.a.string.isRequired};const yt=e=>Object(r.createElement)(ut,{className:e.className},Object(r.createElement)(pt,{className:e.className+"__header"},e.title?e.title:e.feed.title),Object(r.createElement)(ht,{className:e.className+"__posts",role:"list"},e.feed.items.map(t=>Object(r.createElement)(gt,{className:e.className+"__post",key:t.link,title:t.title,link:t.link,description:t.description}))),e.footerLinkText&&Object(r.createElement)(mt,{className:e.className+"__footer"},Object(r.createElement)(ft,{className:e.className+"__footer-link",href:e.feedLink?e.feedLink:e.feed.link},e.footerLinkText)));yt.propTypes={className:l.a.string,feed:l.a.object.isRequired,title:l.a.string,footerLinkText:l.a.string,feedLink:l.a.string},yt.defaultProps={className:"articlelist-feed"};var vt=yt;const xt=c.a.span`
	position: absolute;
	
	top: 8px;
	left: -8px;
	
	font-weight: 500;
	color: ${e=>e.textColor};
	line-height: 16px;
	
	background-color: ${e=>e.backgroundColor};
	padding: 8px 16px;
	box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2);
`,Ot=c.a.span`
	position: absolute;
	
	top: 40px;
	left: -8px;
	
	/* This code makes the triangle. */
	border-top: 8px solid ${d.colors.$color_purple_dark};
	border-left: 8px solid transparent;
`;function Ct(e){return Object(r.createElement)(n.Fragment,null,Object(r.createElement)(xt,{backgroundColor:e.backgroundColor,textColor:e.textColor},e.children),Object(r.createElement)(Ot,null))}Ct.propTypes={backgroundColor:l.a.string,textColor:l.a.string,children:l.a.any},Ct.defaultProps={backgroundColor:d.colors.$color_pink_dark,textColor:d.colors.$color_white,children:null};const wt=c.a.div`
	position: relative;
	display: flex;
	flex-direction: column;
	background-color: ${d.colors.$color_white};
	width: 100%;
	box-shadow: 0 2px 4px 0 rgba(0,0,0,0.2);
`,_t=c.a.img`
	width: 100%;
	vertical-align: bottom;
`,jt=c.a.div`
	padding: 12px 16px;
	display: flex;
	flex-direction: column;
	flex-grow: 1;
`,Et=c.a.a`
	text-decoration: none;
	color: ${d.colors.$color_pink_dark};
	/* IE11 bug header image height see https://github.com/philipwalton/flexbugs#flexbug-5 */
	overflow: hidden;

	&:hover,
	&:focus,
	&:active {
		text-decoration: underline;
		color: ${d.colors.$color_pink_dark};
	}

	&:focus,
	&:active {
		box-shadow: none;
	}
`,kt=c.a.h2`
	margin: 16px 16px 0 16px;
	font-weight: 400;
	font-size: 1.5em;
	line-height: 1.2;
	color: currentColor;
`,St=Object(u.makeOutboundLink)(Et);class Tt extends a.a.Component{getHeader(){return this.props.header?this.props.header.link?Object(r.createElement)(St,{href:this.props.header.link},Object(r.createElement)(_t,{src:this.props.header.image,alt:""}),Object(r.createElement)(kt,null,this.props.header.title)):Object(r.createElement)(n.Fragment,null,Object(r.createElement)(_t,{src:this.props.header.image,alt:""}),";",Object(r.createElement)(kt,null,this.props.header.title)):null}getBanner(){return this.props.banner?Object(r.createElement)(Ct,this.props.banner,this.props.banner.text):null}render(){return Object(r.createElement)(wt,{className:this.props.className,id:this.props.id},this.getHeader(),this.getBanner(),Object(r.createElement)(jt,null,this.props.children))}}var $t=Tt;const qt=c()(Tt)`
	height: 100%;
`;Tt.propTypes={className:l.a.string,id:l.a.string,header:l.a.shape({title:l.a.string,image:l.a.string.isRequired,link:l.a.string}),banner:l.a.shape({text:l.a.string.isRequired,textColor:l.a.string,backgroundColor:l.a.string}),children:l.a.any},Tt.defaultProps={className:"",id:"",header:null,banner:null,children:null};const Nt=c.a.a`
	color: ${d.colors.$color_black};
	white-space: nowrap;
	display: block;
	border-radius: 4px;
	background-color: ${d.colors.$color_grey_cta};
	padding: 12px 16px;
	box-shadow: inset 0 -4px 0 rgba(0, 0, 0, 0.2);
	border: none;
	text-decoration: none;
	font-weight: bold;
	font-size: inherit;
	margin-bottom: 8px;

	&:hover,
	&:focus,
	&:active {
		color: ${d.colors.$color_black};
		background-color: ${d.colors.$color_grey_hover};
	}

	&:active {
		background-color: ${d.colors.$color_grey_hover};
		transform: translateY( 1px );
		box-shadow: none;
		filter: none;
	}
`,Rt=c.a.a`
	cursor: pointer;
	color: ${d.colors.$color_black};
	white-space: nowrap;
	display: block;
	border-radius: 4px;
	background-color: ${d.colors.$color_button_upsell};
	padding: 12px 16px;
	box-shadow: inset 0 -4px 0 rgba(0, 0, 0, 0.2);
	border: none;
	text-decoration: none;
	font-weight: bold;
	font-size: inherit;
	margin-top: 0;
	margin-bottom: 8px;

	&:hover,
	&:focus,
	&:active {
		color: ${d.colors.$color_black};
		background: ${d.colors.$color_button_upsell_hover};
	}

	&:active {
		background-color: ${d.colors.$color_button_hover_upsell};
		transform: translateY( 1px );
		box-shadow: none;
		filter: none;
	}
`,Pt=c.a.a`
	font-weight: bold;
`,Bt=Object(u.makeOutboundLink)(Pt),It=c.a.div`
	text-align: center;
`,zt=c.a.div`
	ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
	}

	li {
		position: relative;
		${Object(u.getDirectionalStyle)("margin-left","margin-right")}: 16px;

		&:before {
			content: "✓";
			color: ${d.colors.$color_green};
			position: absolute;
			font-weight: bold;
			display: inline-block;
			${Object(u.getDirectionalStyle)("left","right")}: -16px;
		}
	}
`,Mt=c.a.div`
	margin-bottom: 12px;
	border-bottom: 1px ${d.colors.$color_grey} solid;
	flex-grow: 1;
`;class Lt extends a.a.Component{getActionBlock(e,t){const o=Object(u.makeOutboundLink)(e);return"true"===t?Object(r.createElement)(It,null,Object(r.createElement)(o,{href:this.props.courseUrl},this.props.ctaButtonData.ctaButtonCopy)):Object(r.createElement)(It,null,Object(r.createElement)(o,{href:this.props.ctaButtonData.ctaButtonUrl},this.props.ctaButtonData.ctaButtonCopy),Object(r.createElement)(Bt,{href:this.props.courseUrl},this.props.readMoreLinkText))}render(){const e="regular"===this.props.ctaButtonData.ctaButtonType?Nt:Rt;return Object(r.createElement)(n.Fragment,null,Object(r.createElement)(Mt,null,Object(r.createElement)(zt,{dangerouslySetInnerHTML:{__html:this.props.description}})),this.getActionBlock(e,this.props.isBundle))}}var Dt=Lt;Lt.propTypes={description:l.a.string,courseUrl:l.a.string,ctaButtonData:l.a.object,readMoreLinkText:l.a.string,isBundle:l.a.string},Lt.defaultProps={description:"",courseUrl:"",ctaButtonData:{},readMoreLinkText:"",isBundle:""};var At=o(39),Ft=o.n(At);const Ut=j()([T,k,S])(c.a.button`
		display: inline-flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		cursor: pointer;
		box-sizing: border-box;
		border: 1px solid transparent;
		margin: 0;
		padding: 8px;
		overflow: visible;
		font-family: inherit;
		font-weight: inherit;
		color: ${e=>e.textColor};
		background: ${e=>e.backgroundColor};
		font-size: ${e=>e.textFontSize};

		svg {
			margin: 0 0 8px;
			flex-shrink: 0;
			fill: currentColor;
			// Safari 10
			align-self: center;
		}

		&:active {
			box-shadow: none;
		}
	`),Ht=e=>{const{children:t,icon:o,textColor:n}=e,a=Ft()(e,"icon");return Object(r.createElement)(Ut,a,Object(r.createElement)(y,{icon:o,color:n}),t)};Ht.propTypes={type:l.a.string,icon:l.a.string.isRequired,textColor:l.a.string,textFontSize:l.a.string,backgroundColor:l.a.string,borderColor:l.a.string,hoverColor:l.a.string,hoverBackgroundColor:l.a.string,hoverBorderColor:l.a.string,activeColor:l.a.string,activeBackgroundColor:l.a.string,activeBorderColor:l.a.string,focusColor:l.a.string,focusBackgroundColor:l.a.string,focusBorderColor:l.a.string,focusBoxShadowColor:l.a.string,children:l.a.oneOfType([l.a.arrayOf(l.a.node),l.a.node,l.a.string]).isRequired},Ht.defaultProps={type:"button",textColor:d.colors.$color_blue,textFontSize:"inherit",backgroundColor:"transparent",borderColor:"transparent",hoverColor:d.colors.$color_white,hoverBackgroundColor:d.colors.$color_blue,hoverBorderColor:d.colors.$color_button_border_hover,activeColor:d.colors.$color_white,activeBackgroundColor:d.colors.$color_blue,activeBorderColor:d.colors.$color_button_border_active,focusColor:d.colors.$color_white,focusBackgroundColor:d.colors.$color_blue,focusBorderColor:d.colors.$color_blue,focusBoxShadowColor:d.colors.$color_blue_dark};var Wt=Ht;const Vt=e=>{const{children:t,icon:o,iconColor:n}=e;let a=y;t&&(a=function(e){return c()(e)`
		margin: ${Object(u.getDirectionalStyle)("0 8px 0 0","0 0 0 8px")};
		flex-shrink: 0;
	`}(a));const s=Ft()(e,"icon");return Object(r.createElement)(N,s,Object(r.createElement)(a,{icon:o,color:n}),t)};Vt.propTypes={icon:l.a.string.isRequired,iconColor:l.a.string,children:l.a.oneOfType([l.a.arrayOf(l.a.node),l.a.node,l.a.string])},Vt.defaultProps={iconColor:"#000"};var Kt=Vt,Gt=o(40);const Yt=c.a.p`
	text-align: center;
	margin: 0 0 16px;
	padding: 16px 16px 8px 16px;
	border-bottom: 4px solid ${d.colors.$color_bad};
	background: ${d.colors.$color_white};
`;class Zt extends a.a.Component{constructor(e){super(e),this.state={hasError:!1}}componentDidCatch(){this.setState({hasError:!0})}render(){if(this.state.hasError){const e=Object(U.__)("Something went wrong. Please reload the page.","wordpress-seo");return Object(Gt.speak)(e,"assertive"),Object(r.createElement)(Yt,null,e)}return this.props.children}}Zt.propTypes={children:l.a.any},Zt.defaultProps={children:null};const Xt=c.a.p`
	color: ${e=>e.textColor};
	font-size: ${e=>e.textFontSize};
	margin-top: 0;
`;class Jt extends n.PureComponent{render(){const{children:e,textColor:t,textFontSize:o}=this.props;return Object(r.createElement)(Xt,{textColor:t,textFontSize:o},e)}}const Qt={children:l.a.oneOfType([l.a.string,l.a.array]),textColor:l.a.string,textFontSize:l.a.string};Jt.propTypes={...Qt,children:Qt.children.isRequired},Jt.defaultProps={textColor:d.colors.$color_help_text};const eo=e=>{const t=c()(e.icon)`
		width: ${e.width};
		height: ${e.height};
		${e.color?`fill: ${e.color};`:""}
		flex: 0 0 auto;
	`,o=Ft()(e,["icon","width","height","color"]);return Object(r.createElement)(t,B()({role:"img","aria-hidden":"true",focusable:"false"},o))};eo.propTypes={icon:l.a.func.isRequired,width:l.a.string,height:l.a.string,color:l.a.string},eo.defaultProps={width:"16px",height:"16px"};var to=eo;const oo=c.a.button`
	box-sizing: border-box;
	min-width: 32px;
	display: inline-block;
	border: 1px solid ${d.colors.$color_button_border};
	background-color: ${e=>e.pressed?e.pressedBackground:e.unpressedBackground};
	box-shadow: ${e=>e.pressed?"inset 0 2px 0 "+Object(d.rgba)(e.pressedBoxShadowColor,.7):"0 1px 0 "+Object(d.rgba)(e.unpressedBoxShadowColor,.7)};
	border-radius: 3px;
	cursor: pointer;
	padding: 0;
	height: ${e=>e.pressed?"23px":"24px"};

	&:hover {
		border-color: ${e=>e.hoverBorderColor};
	}
	&:disabled {
		background-color: ${e=>e.unpressedBackground};
		box-shadow: none;
		border: none;
		cursor: default;
	}
`,ro=function(e){const t="disabled"===e.marksButtonStatus;let o;return o=t?e.disabledIconColor:e.pressed?e.pressedIconColor:e.unpressedIconColor,Object(r.createElement)(oo,{disabled:t,type:"button",onClick:e.onClick,pressed:e.pressed,unpressedBoxShadowColor:e.unpressedBoxShadowColor,pressedBoxShadowColor:e.pressedBoxShadowColor,pressedBackground:e.pressedBackground,unpressedBackground:e.unpressedBackground,id:e.id,"aria-label":e.ariaLabel,"aria-pressed":e.pressed,unpressedIconColor:t?e.disabledIconColor:e.unpressedIconColor,pressedIconColor:e.pressedIconColor,hoverBorderColor:e.hoverBorderColor,className:e.className},Object(r.createElement)(y,{icon:e.icon,color:o,size:"18px"}))};ro.propTypes={id:l.a.string.isRequired,ariaLabel:l.a.string.isRequired,onClick:l.a.func.isRequired,unpressedBoxShadowColor:l.a.string,pressedBoxShadowColor:l.a.string,pressedBackground:l.a.string,unpressedBackground:l.a.string,pressedIconColor:l.a.string,unpressedIconColor:l.a.string,icon:l.a.string.isRequired,pressed:l.a.bool.isRequired,hoverBorderColor:l.a.string,marksButtonStatus:l.a.string,disabledIconColor:l.a.string,className:l.a.string},ro.defaultProps={unpressedBoxShadowColor:d.colors.$color_button_border,pressedBoxShadowColor:d.colors.$color_purple,pressedBackground:d.colors.$color_pink_dark,unpressedBackground:d.colors.$color_button,pressedIconColor:d.colors.$color_white,unpressedIconColor:d.colors.$color_button_text,hoverBorderColor:d.colors.$color_white,marksButtonStatus:"enabled",disabledIconColor:d.colors.$color_grey};var no=ro;const ao=c.a.button`
	box-sizing: border-box;
	min-width: 32px;
	display: inline-block;
	border: 1px solid ${d.colors.$color_button_border};
	background-color: ${e=>e.background};
	box-shadow: ${e=>e.boxShadowColor};
	border-radius: 3px;
	cursor: pointer;
	padding: 0;
	height: "24px";
	&:hover {
		border-color: ${e=>e.hoverBorderColor};
	}
`,so=function(e){return Object(r.createElement)(ao,{type:"button",onClick:e.onClick,boxShadowColor:e.boxShadowColor,background:e.background,id:e.id,"aria-label":e.ariaLabel,iconColor:e.iconColor,hoverBorderColor:e.hoverBorderColor,className:e.className},Object(r.createElement)(y,{icon:e.icon,color:e.iconColor,size:"18px"}))};so.propTypes={id:l.a.string.isRequired,ariaLabel:l.a.string.isRequired,onClick:l.a.func.isRequired,boxShadowColor:l.a.string,background:l.a.string,iconColor:l.a.string,icon:l.a.string.isRequired,hoverBorderColor:l.a.string,className:l.a.string},so.defaultProps={boxShadowColor:d.colors.$color_button_border,background:d.colors.$color_button,iconColor:d.colors.$color_button_text,hoverBorderColor:d.colors.$color_white};var lo=so;function io(e){return Object(r.createElement)("iframe",B()({title:e.title},e))}io.propTypes={title:l.a.string.isRequired};class co extends a.a.Component{constructor(e){super(e),this.setReference=this.setReference.bind(this)}componentDidUpdate(){this.props.hasFocus&&this.ref.focus()}setReference(e){this.ref=e}render(){return Object(r.createElement)("input",B()({ref:this.setReference,type:this.props.type,name:this.props.name,defaultValue:this.props.value,onChange:this.props.onChange,autoComplete:this.props.autoComplete,className:this.props.className},this.props.optionalAttributes))}}co.propTypes={name:l.a.string,type:l.a.oneOf(["button","checkbox","number","password","progress","radio","submit","text"]),value:l.a.any,onChange:l.a.func,optionalAttributes:l.a.object,hasFocus:l.a.bool,autoComplete:l.a.string,className:l.a.string},co.defaultProps={name:"input",type:"text",value:"",hasFocus:!1,className:"",onChange:null,optionalAttributes:{},autoComplete:null};var uo=co,po=o(32),ho=o.n(po);class fo extends a.a.Component{constructor(e){super(e),this.state={words:[]}}static getDerivedStateFromProps(e){const t=[...e.words];t.sort((e,t)=>t.getOccurrences()-e.getOccurrences());const o=t.map(e=>e.getOccurrences()),r=Math.max(...o);return{words:t.map(e=>{const t=e.getOccurrences();return{name:e.getWord(),number:t,width:t/r*100}})}}render(){return Object(r.createElement)("div",null,this.props.header,this.props.introduction,Object(r.createElement)(ie,{items:this.state.words}),this.props.footer)}}fo.propTypes={words:l.a.array.isRequired,header:l.a.element,introduction:l.a.element,footer:l.a.element},fo.defaultProps={header:null,introduction:null,footer:null};var bo=fo;const mo=e=>{let{words:t,researchArticleLink:o}=e;const n=Object(r.createElement)("p",{className:"yoast-field-group__title"},Object(U.__)("Prominent words","wordpress-seo")),a=Object(r.createElement)("p",null,0===t.length?Object(U.__)("Once you add a bit more copy, we'll give you a list of words that occur the most in the content. These give an indication of what your content focuses on.","wordpress-seo"):Object(U.__)("The following words occur the most in the content. These give an indication of what your content focuses on. If the words differ a lot from your topic, you might want to rewrite your content accordingly. ","wordpress-seo")),s=Object(r.createElement)("p",null,(e=>{const t=Object(U.sprintf)(Object(U.__)("Read our %1$sultimate guide to keyword research%2$s to learn more about keyword research and keyword strategy.","wordpress-seo"),"{{a}}","{{/a}}");return ho()({mixedString:t,components:{a:Object(r.createElement)("a",{href:e,target:"_blank"})}})})(o));return Object(r.createElement)(bo,{words:t,header:n,introduction:a,footer:s})};mo.propTypes={words:l.a.arrayOf(l.a.object).isRequired,researchArticleLink:l.a.string.isRequired};var go=mo;const yo=c.a.div`
	cursor: pointer;
	font-size: 14px;
	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
	margin: 4px 0;
	color: #303030;
	font-weight: 500;
`,vo=e=>Object(r.createElement)("label",B()({htmlFor:e.for,className:e.className},e.optionalAttributes),e.children);vo.propTypes={for:l.a.string.isRequired,optionalAttributes:l.a.shape({"aria-label":l.a.string,onClick:l.a.func,className:l.a.string}),children:l.a.any.isRequired,className:l.a.string},vo.defaultProps={className:"",optionalAttributes:{}};var xo=vo;const Oo=c.a.p`
	margin: 1em 0;
`,Co=Object(u.makeOutboundLink)(c.a.a`
	margin-left: 4px;
`);class wo extends n.PureComponent{render(){const{changeLanguageLink:e,canChangeLanguage:t,language:o,showLanguageNotice:n}=this.props;if(!n)return null;
/* Translators: %s expands to the actual language. */let a=Object(U.__)("Your site language is set to %s. ","wordpress-seo");return t||(
/* Translators: %s expands to the actual language. */
a=Object(U.__)("Your site language is set to %s. If this is not correct, contact your site administrator.","wordpress-seo")),a=Object(U.sprintf)(a,`{{strong}}${o}{{/strong}}`),a=ho()({mixedString:a,components:{strong:Object(r.createElement)("strong",null)}}),Object(r.createElement)(Oo,null,a,t&&Object(r.createElement)(Co,{href:e},Object(U.__)("Change language","wordpress-seo")))}}const _o={changeLanguageLink:l.a.string.isRequired,canChangeLanguage:l.a.bool,language:l.a.string.isRequired,showLanguageNotice:l.a.bool};wo.propTypes=_o,wo.defaultProps={canChangeLanguage:!1,showLanguageNotice:!1};const jo=e=>{let{className:t}=e;return""!==t&&(t+=" "),t+="yoast-loader",Object(r.createElement)("svg",{version:"1.1",id:"Y__x2B__bg",x:"0px",y:"0px",viewBox:"0 0 500 500",className:t},Object(r.createElement)("g",null,Object(r.createElement)("g",null,Object(r.createElement)("linearGradient",{id:"SVGID_1_",gradientUnits:"userSpaceOnUse",x1:"250",y1:"428.6121",x2:"250",y2:"77.122"},Object(r.createElement)("stop",{offset:"0",style:{stopColor:"#570732"}}),Object(r.createElement)("stop",{offset:"2.377558e-02",style:{stopColor:"#5D0936"}}),Object(r.createElement)("stop",{offset:"0.1559",style:{stopColor:"#771549"}}),Object(r.createElement)("stop",{offset:"0.3019",style:{stopColor:"#8B1D58"}}),Object(r.createElement)("stop",{offset:"0.4669",style:{stopColor:"#992362"}}),Object(r.createElement)("stop",{offset:"0.6671",style:{stopColor:"#A12768"}}),Object(r.createElement)("stop",{offset:"1",style:{stopColor:"#A4286A"}})),Object(r.createElement)("path",{fill:"url(#SVGID_1_)",d:"M454.7,428.6H118.4c-40.2,0-73.2-32.9-73.2-73.2V150.3c0-40.2,32.9-73.2,73.2-73.2h263.1 c40.2,0,73.2,32.9,73.2,73.2V428.6z"})),Object(r.createElement)("g",null,Object(r.createElement)("g",null,Object(r.createElement)("g",null,Object(r.createElement)("g",null,Object(r.createElement)("path",{fill:"#A4286A",d:"M357.1,102.4l-43.8,9.4L239.9,277l-47.2-147.8h-70.2l78.6,201.9c6.7,17.2,6.7,36.3,0,53.5 c-6.7,17.2,45.1-84.1,24.7-75.7c0,0,34.9,97.6,36.4,94.5c7-14.3,13.7-30.3,20.2-48.5L387.4,72 C387.4,72,358.4,102.4,357.1,102.4z"}))))),Object(r.createElement)("g",null,Object(r.createElement)("linearGradient",{id:"SVGID_2_",gradientUnits:"userSpaceOnUse",x1:"266.5665",y1:"-6.9686",x2:"266.5665",y2:"378.4586"},Object(r.createElement)("stop",{offset:"0",style:{stopColor:"#77B227"}}),Object(r.createElement)("stop",{offset:"0.4669",style:{stopColor:"#75B027"}}),Object(r.createElement)("stop",{offset:"0.635",style:{stopColor:"#6EAB27"}}),Object(r.createElement)("stop",{offset:"0.7549",style:{stopColor:"#63A027"}}),Object(r.createElement)("stop",{offset:"0.8518",style:{stopColor:"#529228"}}),Object(r.createElement)("stop",{offset:"0.9339",style:{stopColor:"#3C7F28"}}),Object(r.createElement)("stop",{offset:"1",style:{stopColor:"#246B29"}})),Object(r.createElement)("path",{fill:"url(#SVGID_2_)",d:"M337,6.1l-98.6,273.8l-47.2-147.8H121L199.6,334c6.7,17.2,6.7,36.3,0,53.5 c-8.8,22.5-23.4,41.8-59,46.6v59.9c69.4,0,106.9-42.6,140.3-136.1L412.1,6.1H337z"}),Object(r.createElement)("path",{fill:"#FFFFFF",d:"M140.6,500h-6.1v-71.4l5.3-0.7c34.8-4.7,46.9-24.2,54.1-42.7c6.2-15.8,6.2-33.2,0-49l-81.9-210.3h83.7 l43.1,134.9L332.7,0h88.3L286.7,359.9c-17.9,50-36.4,83.4-58.1,105.3C205,488.9,177,500,140.6,500z M146.7,439.2v48.3 c29.9-1.2,53.3-11.1,73.1-31.1c20.4-20.5,38-52.6,55.3-100.9L403.2,12.3h-61.9L238.1,299l-51.3-160.8H130l75.3,193.5 c7.3,18.7,7.3,39.2,0,57.9C197.7,409.3,184.1,432.4,146.7,439.2z"}))))};jo.propTypes={className:l.a.string},jo.defaultProps={className:""};const Eo=i.keyframes`
	0%   { transform: scale( 0.70 ); opacity: 0.4; }
	80%  { opacity: 1 }
	100%  { transform: scale( 0.95 ); opacity: 1 }
`;var ko=c()(jo)`
	animation: ${Eo} 1.15s infinite;
	animation-direction: alternate;
	animation-timing-function: cubic-bezier(0.96, 0.02, 0.63, 0.86);
`;const So=c.a.div`
	padding: 8px;
`,To=c.a.ol`
	padding: 0;
	margin: 0;

	list-style: none;
	counter-reset: multi-step-progress-counter;

	li {
		counter-increment: multi-step-progress-counter;
	}
`,$o=c.a.li`
	display: flex;
	align-items: baseline;

	margin: 8px 0;

	:first-child {
		margin-top: 0;
	}

	:last-child {
		margin-bottom: 0;
	}

	span {
		margin: 0 8px;
	}

	svg {
		position: relative;
		top: 2px;
	}

	::before {
		content: counter( multi-step-progress-counter );
		font-size: 12px;
		background: ${d.colors.$color_pink_dark};
		border-radius: 50%;
		min-width: 16px;
		height: 16px;
		padding: 4px;
		color: ${d.colors.$color_white};
		text-align: center;
	}
`,qo=c()($o)`
	span {
		color: ${d.colors.$palette_grey_text_light};
	}

	::before {
		background-color: ${d.colors.$palette_grey_medium_dark};
	}
`,No=c()($o)`
	::before {
		background-color: ${d.colors.$palette_grey_medium_dark};
	}
`;class Ro extends a.a.Component{render(){return Object(r.createElement)(So,{role:"status","aria-live":"polite","aria-relevant":"additions text","aria-atomic":!0},Object(r.createElement)(To,null,this.props.steps.map(e=>{switch(e.status){case"running":return this.renderRunningState(e);case"failed":return this.renderFailedState(e);case"finished":return this.renderFinishedState(e);case"pending":default:return this.renderPendingState(e)}})))}renderPendingState(e){return Object(r.createElement)(qo,{key:e.id},Object(r.createElement)("span",null,e.text))}renderRunningState(e){return Object(r.createElement)(No,{key:e.id},Object(r.createElement)("span",null,e.text),Object(r.createElement)(y,{icon:"loading-spinner"}))}renderFinishedState(e){return Object(r.createElement)($o,{key:e.id},Object(r.createElement)("span",null,e.text),Object(r.createElement)(y,{icon:"check",color:d.colors.$color_green_medium_light}))}renderFailedState(e){return Object(r.createElement)($o,{key:e.id},Object(r.createElement)("span",null,e.text),Object(r.createElement)(y,{icon:"times",color:d.colors.$color_red}))}}Ro.defaultProps={steps:[]},Ro.propTypes={steps:l.a.arrayOf(l.a.shape({status:l.a.oneOf(["pending","running","finished","failed"]).isRequired,text:l.a.string.isRequired,id:l.a.string.isRequired}))};var Po=Ro;const Bo=c.a.div`
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
	background-color: ${e=>e.backgroundColor};
	min-height: ${e=>e.minHeight};
`;Bo.propTypes={backgroundColor:l.a.string,minHeight:l.a.string},Bo.defaultProps={backgroundColor:d.colors.$color_white,minHeight:"0"};var Io=Bo;const zo=c.a.div`
	display: flex;
	align-items: center;
	padding: 24px;

	h1, h2, h3, h4, h5, h6 {
		font-size: 1.4em;
		line-height: 1;
		margin: 0 0 4px 0;

		@media screen and ( max-width: ${d.breakpoints.mobile} ) {
			${e=>e.isDismissable?"margin-right: 30px;":""}
		}
	}

	p:last-child {
		margin: 0;
	}

	@media screen and ( max-width: ${d.breakpoints.mobile} ) {
		display: block;
		position: relative;
		padding: 16px;
	}
`,Mo=c.a.img`
	flex: 0 0 ${e=>e.imageWidth?e.imageWidth:"auto"};
	height: ${e=>e.imageHeight?e.imageHeight:"auto"};
	margin-right: 24px;

	@media screen and ( max-width: ${d.breakpoints.mobile} ) {
		display: none;
	}
`,Lo=c.a.div`
	flex: 1 1 auto;
`,Do=c.a.button`
	flex: 0 0 40px;
	height: 40px;
	border: 0;
	margin: 0 0 0 10px;
	padding: 0;
	background: transparent;
	cursor: pointer;

	@media screen and ( max-width: ${d.breakpoints.mobile} ) {
		width: 40px;
		position: absolute;
		top: 5px;
		right: 5px;
		margin: 0;
	}
`,Ao=c()(y)`
	vertical-align: middle;
`;function Fo(e){const t=""+e.headingLevel;return Object(r.createElement)(Io,null,Object(r.createElement)(zo,{isDismissable:e.isDismissable},e.imageSrc&&Object(r.createElement)(Mo,{src:e.imageSrc,imageWidth:e.imageWidth,imageHeight:e.imageHeight,alt:""}),Object(r.createElement)(Lo,null,Object(r.createElement)(t,null,e.title),Object(r.createElement)("p",{className:"prova",dangerouslySetInnerHTML:{__html:e.html}})),e.isDismissable&&Object(r.createElement)(Do,{onClick:e.onClick,type:"button","aria-label":Object(U.__)("Dismiss this notice","wordpress-seo")},Object(r.createElement)(Ao,{icon:"times",color:d.colors.$color_grey_text,size:"24px"}))))}Fo.propTypes={imageSrc:l.a.string,imageWidth:l.a.string,imageHeight:l.a.string,title:l.a.string,html:l.a.string,isDismissable:l.a.bool,onClick:l.a.func,headingLevel:l.a.string},Fo.defaultProps={isDismissable:!1,headingLevel:"h3"};var Uo=Fo;const Ho=c.a.progress`
	box-sizing: border-box;
	width: 100%;
	height: 8px;
	display: block;
	margin-top: 8px;
	appearance: none;
	background-color: ${e=>e.backgroundColor};
	border: 1px solid ${e=>e.borderColor};

	::-webkit-progress-bar {
	   	background-color: ${e=>e.backgroundColor};
	}

	::-webkit-progress-value {
		background-color: ${e=>e.progressColor};
		transition: width 250ms;
	}

	::-moz-progress-bar {
		background-color: ${e=>e.progressColor};
	}
	
	::-ms-fill {
		background-color: ${e=>e.progressColor};
		border: 0;
	}
`;Ho.defaultProps={max:1,value:0,progressColor:d.colors.$color_good,backgroundColor:d.colors.$color_background_light,borderColor:d.colors.$color_input_border,"aria-hidden":"true"},Ho.propTypes={max:l.a.number,value:l.a.number,progressColor:l.a.string,backgroundColor:l.a.string,borderColor:l.a.string,"aria-hidden":l.a.string};var Wo=Ho;const Vo=c.a.li`
	display: table-row;
	font-size: 14px;
`,Ko=c.a.span`
	display: table-cell;
	padding: 2px;
`,Go=c()(Ko)`
	position: relative;
	top: 1px;
	display: inline-block;
	height: 8px;
	width: 8px;
	border-radius: 50%;
	background-color: ${e=>e.scoreColor};
`;Go.propTypes={scoreColor:l.a.string.isRequired};const Yo=c()(Ko)`
	padding-left: 8px;
	width: 100%;
`,Zo=c()(Ko)`
	font-weight: 600;
	text-align: right;
	padding-left: 16px;
`,Xo=e=>Object(r.createElement)(Vo,{className:""+e.className},Object(r.createElement)(Go,{className:e.className+"-bullet",scoreColor:e.scoreColor}),Object(r.createElement)(Yo,{className:e.className+"-text",dangerouslySetInnerHTML:{__html:e.html}}),e.value&&Object(r.createElement)(Zo,{className:e.className+"-score"},e.value));Xo.propTypes={className:l.a.string.isRequired,scoreColor:l.a.string.isRequired,html:l.a.string.isRequired,value:l.a.number};const Jo=c.a.ul`
	display: table;
	box-sizing: border-box;
	list-style: none;
	max-width: 100%;
	min-width: 200px;
	margin: 8px 0;
	padding: 0 8px;
`,Qo=e=>Object(r.createElement)(Jo,{className:e.className,role:"list"},e.items.map((t,o)=>Object(r.createElement)(Xo,{className:e.className+"__item",key:o,scoreColor:t.color,html:t.html,value:t.value})));Qo.propTypes={className:l.a.string,items:l.a.arrayOf(l.a.shape({color:l.a.string.isRequired,html:l.a.string.isRequired,value:l.a.number}))},Qo.defaultProps={className:"score-assessments"};var er=Qo;const tr=c.a.div`
	margin: 8px 0;
	height: ${e=>e.barHeight};
	overflow: hidden;
`,or=c.a.span`
	display: inline-block;
	vertical-align: top;
	width: ${e=>e.progressWidth+"%"};
	background-color: ${e=>e.progressColor};
	height: 100%;
`;or.propTypes={progressWidth:l.a.number.isRequired,progressColor:l.a.string.isRequired};const rr=e=>{let t=0;for(let o=0;o<e.items.length;o++)e.items[o].value=Math.max(e.items[o].value,0),t+=e.items[o].value;return t<=0?null:Object(r.createElement)(tr,{className:e.className,barHeight:e.barHeight},e.items.map((o,n)=>Object(r.createElement)(or,{className:e.className+"__part",key:n,progressColor:o.color,progressWidth:o.value/t*100})))};rr.propTypes={className:l.a.string,items:l.a.arrayOf(l.a.shape({value:l.a.number.isRequired,color:l.a.string.isRequired})),barHeight:l.a.string},rr.defaultProps={className:"stacked-progress-bar",barHeight:"24px"};var nr=rr;const ar=c.a.div.attrs({})`
	flex: 0 1 100%;
	border: 1px solid ${e=>e.isActive?"#5b9dd9":"#ddd"};
	padding: 4px 5px;
	box-sizing: border-box;
	box-shadow: ${e=>e.isActive?"0 0 2px rgba(30,140,190,.8);":"inset 0 1px 2px rgba(0,0,0,.07)"};
	background-color: #fff;
	color: #32373c;
	outline: 0;
	transition: 50ms border-color ease-in-out;
	position: relative;
	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
	font-size: 14px;
	cursor: text;
`,sr=c.a.div`
	display: flex;
	flex-direction: column;
	margin: 1em 0;
`,lr=c.a.input`
	&&& {
		padding: 0 8px;
		min-height: 34px;
		font-size: 1em;
		box-shadow: inset 0 1px 2px ${Object(d.rgba)(d.colors.$color_black,.07)};
		border: 1px solid ${d.colors.$color_input_border};
		border-radius: 0;

		&:focus {
			border-color: #5b9dd9;
			box-shadow: 0 0 2px ${Object(d.rgba)(d.colors.$color_snippet_focus,.8)};
		}
	}
`,ir=c.a.label`
	font-size: 1em;
	font-weight: bold;
	margin-bottom: 0.5em;
	display: block;
`,cr=c.a.span`
	margin-bottom: 0.5em;
`,dr=c()(ir)`
	display: inline-block;
	margin-bottom: 0;
	${Object(u.getDirectionalStyle)("margin-right: 4px","margin-left: 4px")};
`,ur=e=>{const{label:t,helpLink:o,...n}=e;return Object(r.createElement)(sr,null,Object(r.createElement)(cr,null,Object(r.createElement)(dr,{htmlFor:n.id},t),o),Object(r.createElement)(lr,B()({},n,{autoComplete:"off"})))};ur.propTypes={type:l.a.string,id:l.a.string.isRequired,label:l.a.string,helpLink:l.a.node},ur.defaultProps={type:"text",label:"",helpLink:null};var pr=ur;class hr extends a.a.Component{constructor(e){super(e),this.setReference=this.setReference.bind(this)}render(){return Object(r.createElement)("textarea",B()({ref:this.setReference,name:this.props.name,value:this.props.value,onChange:this.props.onChange},this.props.optionalAttributes))}setReference(e){this.ref=e}componentDidUpdate(){this.props.hasFocus&&this.ref.focus()}}hr.propTypes={name:l.a.string,value:l.a.string,onChange:l.a.func,optionalAttributes:l.a.object,hasFocus:l.a.bool},hr.defaultProps={name:"textarea",value:"",hasFocus:!1,onChange:null,optionalAttributes:{}};var fr=hr;class br extends a.a.Component{constructor(e){super(e),this.optionalAttributes=this.parseOptionalAttributes()}render(){return this.optionalAttributes=this.parseOptionalAttributes(),this.props.class&&(this.optionalAttributes.container.className=this.props.class),Object(r.createElement)("div",this.optionalAttributes.container,Object(r.createElement)(xo,{for:this.props.name,optionalAttributes:this.optionalAttributes.label},this.props.label),this.getTextField())}getTextField(){return!0===this.props.multiline?Object(r.createElement)("div",null,Object(r.createElement)(fr,{name:this.props.name,id:this.props.name,onChange:this.props.onChange,optionalAttributes:this.optionalAttributes.field,hasFocus:this.props.hasFocus,value:this.props.value}),this.props.explanation&&Object(r.createElement)("p",null,this.props.explanation)):Object(r.createElement)("div",null,Object(r.createElement)(uo,{name:this.props.name,id:this.props.name,type:"text",onChange:this.props.onChange,value:this.props.value,hasFocus:this.props.hasFocus,autoComplete:this.props.autoComplete,optionalAttributes:this.optionalAttributes.field}),this.props.explanation&&Object(r.createElement)("p",null,this.props.explanation))}parseOptionalAttributes(){const e={},t={},o={id:this.props.name};return Object.keys(this.props).forEach(function(r){r.startsWith("label-")&&(t[r.split("-").pop()]=this.props[r]),r.startsWith("field-")&&(o[r.split("-").pop()]=this.props[r]),r.startsWith("container-")&&(e[r.split("-").pop()]=this.props[r])}.bind(this)),{label:t,field:o,container:e}}}br.propTypes={label:l.a.string.isRequired,name:l.a.string.isRequired,onChange:l.a.func.isRequired,value:l.a.string,optionalAttributes:l.a.object,multiline:l.a.bool,hasFocus:l.a.bool,class:l.a.string,explanation:l.a.string,autoComplete:l.a.string},br.defaultProps={optionalAttributes:{},multiline:!1,hasFocus:!1,value:null,class:null,explanation:!1,autoComplete:null};var mr=br;const gr=c.a.div`
	display: flex;
	width: 100%;
	justify-content: space-between;
	align-items: center;
	position: relative;
`,yr=c.a.span`
	${Object(u.getDirectionalStyle)("margin-right","margin-left")}: 16px;
	flex: 1;
	cursor: pointer;
`,vr=c.a.div`
	background-color: ${e=>e.isEnabled?"#a5d6a7":d.colors.$color_button_border};
	border-radius: 7px;
	height: 14px;
	width: 30px;
	cursor: pointer;
	margin: 0;
	outline: 0;
	&:focus > span {
		box-shadow: inset 0 0 0 1px ${d.colors.$color_white}, 0 0 0 1px #5b9dd9, 0 0 2px 1px rgba(30, 140, 190, .8);
	}
`,xr=c.a.span`
	background-color: ${e=>e.isEnabled?d.colors.$color_green_medium_light:d.colors.$color_grey_medium_dark};
	${e=>e.isEnabled?Object(u.getDirectionalStyle)("margin-left: 12px;","margin-right: 12px;"):Object(u.getDirectionalStyle)("margin-left: -2px;","margin-right: -2px;")};
	box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.1);
	border-radius: 100%;
	height: 20px;
	width: 20px;
	position: absolute;
	margin-top: -3px;
`,Or=c.a.span`
	font-size: 14px;
	line-height: 20px;
	${Object(u.getDirectionalStyle)("margin-left","margin-right")}: 8px;
	font-style: italic;
`;class Cr extends a.a.Component{constructor(e){super(e),this.onClick=this.props.onToggleDisabled,this.onKeyUp=this.props.onToggleDisabled,this.setToggleState=this.setToggleState.bind(this),this.handleOnKeyDown=this.handleOnKeyDown.bind(this),!0!==e.disable&&(this.onClick=this.setToggleState.bind(this),this.onKeyUp=this.setToggleState.bind(this))}setToggleState(e){"keyup"===e.type&&32!==e.keyCode||this.props.onSetToggleState(!this.props.isEnabled)}handleOnKeyDown(e){32===e.keyCode&&e.preventDefault()}render(){return Object(r.createElement)(gr,null,this.props.labelText&&Object(r.createElement)(yr,{id:this.props.id,onClick:this.onClick},this.props.labelText),Object(r.createElement)(vr,{isEnabled:this.props.isEnabled,onKeyDown:this.handleOnKeyDown,onClick:this.onClick,onKeyUp:this.onKeyUp,tabIndex:"0",role:"checkbox","aria-labelledby":this.props.id,"aria-checked":this.props.isEnabled,"aria-disabled":this.props.disable},Object(r.createElement)(xr,{isEnabled:this.props.isEnabled})),this.props.showToggleStateLabel&&Object(r.createElement)(Or,{"aria-hidden":"true"},this.props.isEnabled?Object(U.__)("On","wordpress-seo"):Object(U.__)("Off","wordpress-seo")))}}Cr.propTypes={isEnabled:l.a.bool,onSetToggleState:l.a.func,disable:l.a.bool,onToggleDisabled:l.a.func,id:l.a.string.isRequired,labelText:l.a.string,showToggleStateLabel:l.a.bool},Cr.defaultProps={isEnabled:!1,onSetToggleState:()=>{},labelText:"",disable:!1,onToggleDisabled:()=>{},showToggleStateLabel:!0};var wr=Cr;function _r(e){return c()(e)`
		display: inline-flex;
		align-items: center;
		justify-content: center;
		vertical-align: middle;
		min-height: ${"48px"};
		margin: 0;
		padding: 0 16px;
		padding: ${"0px"} 16px;
		border: 0;
		border-radius: 4px;
		box-sizing: border-box;
		font: 400 14px/24px "Open Sans", sans-serif;
		text-transform: uppercase;
		box-shadow: 0 2px 8px 0 ${Object(d.rgba)(d.colors.$color_black,.3)};
		transition: box-shadow 150ms ease-out;

		&:hover,
		&:focus,
		&:active {
			box-shadow:
				0 4px 10px 0 ${Object(d.rgba)(d.colors.$color_black,.2)},
				inset 0 0 0 100px ${Object(d.rgba)(d.colors.$color_black,.1)};
			color: ${e=>e.textColor};
		}

		&:active {
			transform: translateY( 1px );
			box-shadow: none;
		}

		// Only needed for IE 10+. Don't add spaces within brackets for this to work.
		@media all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
			::after {
				display: inline-block;
				content: "";
				min-height: ${"48px"};
			}
		}
	`}const jr=e=>{let{className:t,onClick:o,type:n,children:a,isExpanded:s}=e;return Object(r.createElement)("button",{className:t,onClick:o,type:n,"aria-expanded":s},Object(r.createElement)("span",null,a))};jr.propTypes={className:l.a.string,onClick:l.a.func,type:l.a.string,isExpanded:l.a.bool,children:l.a.oneOfType([l.a.arrayOf(l.a.node),l.a.node,l.a.string])},jr.defaultProps={type:"button"};const Er=_r(c()(jr)`
		color: ${e=>e.textColor};
		background: ${e=>e.backgroundColor};
		min-width: 152px;
		${e=>e.withTextShadow?"text-shadow: 0 0 2px "+d.colors.$color_black:""};
		overflow: visible;
		cursor: pointer;

		&::-moz-focus-inner {
			border-width: 0;
		}

		// Only needed for Safari 10 and only for buttons.
		span {
			display: inherit;
			align-items: inherit;
			justify-content: inherit;
			width: 100%;
		}
	`);Er.propTypes={backgroundColor:l.a.string,textColor:l.a.string,withTextShadow:l.a.bool},Er.defaultProps={backgroundColor:d.colors.$color_green_medium_light,textColor:d.colors.$color_white,withTextShadow:!0};const kr=c()(y)`
		margin: 2px 4px 0 4px;
		flex-shrink: 0;
`,Sr=(Tr=c()(jr)`
		color: ${e=>e.textColor};
		background: ${e=>e.backgroundColor};
		overflow: visible;
		cursor: pointer;

		&::-moz-focus-inner {
			border-width: 0;
		}

		// Only needed for Safari 10 and only for buttons.
		span {
			display: inherit;
			align-items: inherit;
			justify-content: inherit;
			width: 100%;
		}
	`,c()(Tr)`
		display: inline-flex;
		align-items: center;
		justify-content: center;
		vertical-align: middle;
		min-height: ${"48px"};
		margin: 0;
		overflow: auto;
		min-width: 152px;
		padding: 0 16px;
		padding: ${"8px"} 8px ${"8px"} 16px;
		border: 0;
		border-radius: 4px;
		box-sizing: border-box;
		font: 400 16px/24px "Open Sans", sans-serif;
		box-shadow: inset 0 -4px 0 rgba(0, 0, 0, 0.2);
		filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
		transition: box-shadow 150ms ease-out;

		&:hover,
		&:focus,
		&:active {
			background: ${d.colors.$color_button_upsell_hover};
		}

		&:active {
			transform: translateY( 1px );
			box-shadow: none;
			filter: none;
		}

		// Only needed for IE 10+. Don't add spaces within brackets for this to work.
		@media all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
			::after {
				display: inline-block;
				content: "";
				min-height: ${"32px"};
			}
		}
	`);var Tr;Sr.propTypes={backgroundColor:l.a.string,hoverColor:l.a.string,textColor:l.a.string},Sr.defaultProps={backgroundColor:d.colors.$color_button_upsell,hoverColor:d.colors.$color_button_hover_upsell,textColor:d.colors.$color_black};const $r=e=>{const{children:t}=e;return Object(r.createElement)(Sr,e,t,Object(r.createElement)(kr,{icon:"caret-right",color:d.colors.$color_black,size:"16px"}))};$r.propTypes={backgroundColor:l.a.string,hoverColor:l.a.string,textColor:l.a.string,children:l.a.oneOfType([l.a.arrayOf(l.a.node),l.a.node])};const qr=c.a.a`
	align-items: center;
	justify-content: center;
	vertical-align: middle;
	color: ${d.colors.$color_black};
	white-space: nowrap;
	display: inline-flex;
	border-radius: 4px;
	background-color: ${d.colors.$color_button_upsell};
	padding: 4px 8px 8px;
	box-shadow: inset 0 -4px 0 rgba(0, 0, 0, 0.2);
	border: none;
	text-decoration: none;
	font-size: inherit;

	&:hover,
	&:focus,
	&:active {
		color: ${d.colors.$color_black};
		background: ${d.colors.$color_button_upsell_hover};
	}

	&:active {
		background-color: ${d.colors.$color_button_hover_upsell};
		transform: translateY( 1px );
		box-shadow: none;
		filter: none;
	}
`,Nr=_r(c.a.a`
		text-decoration: none;
		color: ${e=>e.textColor};
		background: ${e=>e.backgroundColor};
		min-width: 152px;
		${e=>e.withTextShadow?"text-shadow: 0 0 2px "+d.colors.$color_black:""};
	`);Nr.propTypes={backgroundColor:l.a.string,textColor:l.a.string,withTextShadow:l.a.bool},Nr.defaultProps={backgroundColor:d.colors.$color_green_medium_light,textColor:d.colors.$color_white,withTextShadow:!0};var Rr=e=>Object(r.createElement)("svg",B()({},e,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 520 240"}),Object(r.createElement)("linearGradient",{id:"a",gradientUnits:"userSpaceOnUse",x1:"476.05",y1:"194.48",x2:"476.05",y2:"36.513"},Object(r.createElement)("stop",{offset:"0",style:{stopColor:"#570732"}}),Object(r.createElement)("stop",{offset:".038",style:{stopColor:"#610b39"}}),Object(r.createElement)("stop",{offset:".155",style:{stopColor:"#79164b"}}),Object(r.createElement)("stop",{offset:".287",style:{stopColor:"#8c1e59"}}),Object(r.createElement)("stop",{offset:".44",style:{stopColor:"#9a2463"}}),Object(r.createElement)("stop",{offset:".633",style:{stopColor:"#a22768"}}),Object(r.createElement)("stop",{offset:"1",style:{stopColor:"#a4286a"}})),Object(r.createElement)("path",{fill:"url(#a)",d:"M488.7 146.1v-56h20V65.9h-20V36.5h-30.9v29.3h-15.7v24.3h15.7v52.8c0 30 20.9 47.8 43 51.5l9.2-24.8c-12.9-1.6-21.2-11.2-21.3-23.5z"}),Object(r.createElement)("linearGradient",{id:"b",gradientUnits:"userSpaceOnUse",x1:"287.149",y1:"172.553",x2:"287.149",y2:"61.835"},Object(r.createElement)("stop",{offset:"0",style:{stopColor:"#570732"}}),Object(r.createElement)("stop",{offset:".038",style:{stopColor:"#610b39"}}),Object(r.createElement)("stop",{offset:".155",style:{stopColor:"#79164b"}}),Object(r.createElement)("stop",{offset:".287",style:{stopColor:"#8c1e59"}}),Object(r.createElement)("stop",{offset:".44",style:{stopColor:"#9a2463"}}),Object(r.createElement)("stop",{offset:".633",style:{stopColor:"#a22768"}}),Object(r.createElement)("stop",{offset:"1",style:{stopColor:"#a4286a"}})),Object(r.createElement)("path",{fill:"url(#b)",d:"M332.8 137.3V95.2c0-1.5-.1-3-.2-4.4-2.7-34-51-33.9-88.3-20.9L255 91.7c24.3-11.6 38.9-8.6 44-2.9l.4.4v.1c2.6 3.5 2 9 2 13.4-31.8 0-65.7 4.2-65.7 39.1 0 26.5 33.2 43.6 68 18.3l5.2 12.4h29.8c-2.8-14.5-5.9-27-5.9-35.2zm-31.2-.3c-24.5 27.4-46.9 1.6-23.9-9.6 6.8-2.3 15.9-2.4 23.9-2.4v12z"}),Object(r.createElement)("linearGradient",{id:"c",gradientUnits:"userSpaceOnUse",x1:"390.54",y1:"172.989",x2:"390.54",y2:"61.266"},Object(r.createElement)("stop",{offset:"0",style:{stopColor:"#570732"}}),Object(r.createElement)("stop",{offset:".038",style:{stopColor:"#610b39"}}),Object(r.createElement)("stop",{offset:".155",style:{stopColor:"#79164b"}}),Object(r.createElement)("stop",{offset:".287",style:{stopColor:"#8c1e59"}}),Object(r.createElement)("stop",{offset:".44",style:{stopColor:"#9a2463"}}),Object(r.createElement)("stop",{offset:".633",style:{stopColor:"#a22768"}}),Object(r.createElement)("stop",{offset:"1",style:{stopColor:"#a4286a"}})),Object(r.createElement)("path",{fill:"url(#c)",d:"M380.3 92.9c0-10.4 16.6-15.2 42.8-3.3l9.1-22C397 57 348.9 56 348.6 92.8c-.1 17.7 11.2 27.2 27.5 33.2 11.3 4.2 27.6 6.4 27.6 15.4-.1 11.8-25.3 13.6-48.4-2.3l-9.3 23.8c31.4 15.6 89.7 16.1 89.4-23.1-.4-38.5-55.1-31.9-55.1-46.9z"}),Object(r.createElement)("linearGradient",{id:"d",gradientUnits:"userSpaceOnUse",x1:"76.149",y1:"3.197",x2:"76.149",y2:"178.39"},Object(r.createElement)("stop",{offset:"0",style:{stopColor:"#77b227"}}),Object(r.createElement)("stop",{offset:".467",style:{stopColor:"#75b027"}}),Object(r.createElement)("stop",{offset:".635",style:{stopColor:"#6eab27"}}),Object(r.createElement)("stop",{offset:".755",style:{stopColor:"#63a027"}}),Object(r.createElement)("stop",{offset:".852",style:{stopColor:"#529228"}}),Object(r.createElement)("stop",{offset:".934",style:{stopColor:"#3c7f28"}}),Object(r.createElement)("stop",{offset:"1",style:{stopColor:"#246b29"}})),Object(r.createElement)("path",{fill:"url(#d)",d:"M108.2 9.2L63.4 133.6 41.9 66.4H10l35.7 91.8c3 7.8 3 16.5 0 24.3-4 10.2-10.6 19-26.8 21.2v27.2c31.5 0 48.6-19.4 63.8-61.9L142.3 9.2h-34.1z"}),Object(r.createElement)("linearGradient",{id:"e",gradientUnits:"userSpaceOnUse",x1:"175.228",y1:"172.923",x2:"175.228",y2:"62.17"},Object(r.createElement)("stop",{offset:"0",style:{stopColor:"#570732"}}),Object(r.createElement)("stop",{offset:".038",style:{stopColor:"#610b39"}}),Object(r.createElement)("stop",{offset:".155",style:{stopColor:"#79164b"}}),Object(r.createElement)("stop",{offset:".287",style:{stopColor:"#8c1e59"}}),Object(r.createElement)("stop",{offset:".44",style:{stopColor:"#9a2463"}}),Object(r.createElement)("stop",{offset:".633",style:{stopColor:"#a22768"}}),Object(r.createElement)("stop",{offset:"1",style:{stopColor:"#a4286a"}})),Object(r.createElement)("path",{fill:"url(#e)",d:"M175.2 62.2c-38.6 0-54 27.3-54 56.2 0 30 15.1 54.6 54 54.6 38.7 0 54.1-27.6 54-54.6-.1-33-16.8-56.2-54-56.2zm0 87.1c-15.7 0-23.4-11.7-23.4-30.9s8.3-32.9 23.4-32.9c15 0 23.2 13.7 23.2 32.9s-7.5 30.9-23.2 30.9z"})),Pr=o(220),Br=o.n(Pr);const Ir=c.a.h1`
	float: left;
	margin: -4px 0 2rem;
	font-size: 1rem;
`,zr=c.a.button`
	float: right;
	width: 44px;
	height: 44px;
	background: transparent;
	border: 0;
	margin: -16px -16px 0 0;
	padding: 0;
	cursor: pointer;
`;class Mr extends a.a.Component{constructor(e){super(e)}render(){return Object(r.createElement)(Br.a,{isOpen:this.props.isOpen,onRequestClose:this.props.onClose,role:"dialog",contentLabel:this.props.modalAriaLabel,overlayClassName:"yoast-modal__overlay "+this.props.className,className:"yoast-modal__content "+this.props.className,appElement:this.props.appElement,bodyOpenClassName:"yoast-modal_is-open"},Object(r.createElement)("div",null,this.props.heading&&Object(r.createElement)(Ir,{className:"yoast-modal__title"},this.props.heading),this.props.closeIconButton&&Object(r.createElement)(zr,{type:"button",onClick:this.props.onClose,className:"yoast-modal__button-close-icon "+this.props.closeIconButtonClassName,"aria-label":this.props.closeIconButton},Object(r.createElement)(y,{icon:"times",color:d.colors.$color_grey_text}))),Object(r.createElement)("div",{className:"yoast-modal__inside"},this.props.children),this.props.closeButton&&Object(r.createElement)("div",{className:"yoast-modal__actions"},Object(r.createElement)("button",{type:"button",onClick:this.props.onClose,className:"yoast-modal__button-close "+this.props.closeButtonClassName},this.props.closeButton)))}}Mr.propTypes={children:l.a.any,className:l.a.string,isOpen:l.a.bool,onClose:l.a.func.isRequired,modalAriaLabel:l.a.string.isRequired,appElement:l.a.object.isRequired,heading:l.a.string,closeIconButton:l.a.string,closeIconButtonClassName:l.a.string,closeButton:l.a.string,closeButtonClassName:l.a.string},Mr.defaultProps={children:null,className:"",heading:"",closeIconButton:"",closeIconButtonClassName:"",closeButton:"",closeButtonClassName:"",isOpen:!1};var Lr=c()(Mr)`
	&.yoast-modal__overlay {
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: rgba(0, 0, 0, 0.6);
		transition: background 100ms ease-out;
		z-index: 999999;
	}

	&.yoast-modal__content {
		position: absolute;
		top: 50%;
		left: 50%;
		right: auto;
		bottom: auto;
		width: auto;
		max-width: 90%;
		max-height: 90%;
		border: 0;
		border-radius: 0;
		margin-right: -50%;
		padding: 24px;
		transform: translate(-50%, -50%);
		background-color: #fff;
		outline: none;

		@media screen and ( max-width: 500px ) {
			overflow-y: auto;
		}

		@media screen and ( max-height: 640px ) {
			overflow-y: auto;
		}
	}

	.yoast-modal__inside {
		clear: both;
	}

	.yoast-modal__actions {
		text-align: right;
	}

	.yoast-modal__actions button {
		margin: 24px 0 0 8px;
	}
`,Dr=e=>Object(r.createElement)("svg",B()({},e,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 500 500"}),Object(r.createElement)("path",{d:"M80,0H420a80,80,0,0,1,80,80V500a0,0,0,0,1,0,0H80A80,80,0,0,1,0,420V80A80,80,0,0,1,80,0Z",fill:"#a4286a"}),Object(r.createElement)("path",{d:"M437.61,2,155.89,500H500V80A80,80,0,0,0,437.61,2Z",fill:"#6c2548"}),Object(r.createElement)("path",{d:"M74.4,337.3v34.9c21.6-.9,38.5-8,52.8-22.5s27.4-38,39.9-72.9l92.6-248H214.9L140.3, 236l-37-116.2h-41l54.4,139.8a57.54,57.54,0,0,1,0,41.8C111.2,315.6,101.3,332.3,74.4,337.3Z",fill:"#fff"}),Object(r.createElement)("circle",{cx:"368.33",cy:"124.68",r:"97.34",transform:"translate(19.72 296.97) rotate(-45)",fill:"#9fda4f"}),Object(r.createElement)("path",{d:"M416.2,39.93,320.46,209.44A97.34,97.34,0,1,0,416.2,39.93Z",fill:"#77b227"}),Object(r.createElement)("path",{d:"M294.78,254.75h0l-.15-.08-.13-.07h0a63.6,63.6,0,0,0-62.56,110.76h0l.07,0,.06,0h0a63.6,63.6,0,0,0,62.71-110.67Z",fill:"#fec228"}),Object(r.createElement)("path",{d:"M294.5,254.59,231.94,365.35A63.6,63.6,0,1,0,294.5,254.59Z",fill:"#f49a00"}),Object(r.createElement)("path",{d:"M222.31,450.07A38.16,38.16,0,0,0,203,416.83h0l0,0h0a38.18,38.18,0,1,0,19.41,33.27Z",fill:"#ff4e47"}),Object(r.createElement)("path",{d:"M202.9,416.8l-37.54,66.48A38.17,38.17,0,0,0,202.9,416.8Z",fill:"#ed261f"}));function Ar(e){return e.type&&"Tab"===e.type.tabsRole}function Fr(e){return e.type&&"TabPanel"===e.type.tabsRole}function Ur(e){return e.type&&"TabList"===e.type.tabsRole}function Hr(e,t,o){return t in e?Object.defineProperty(e,t,{value:o,enumerable:!0,configurable:!0,writable:!0}):e[t]=o,e}function Wr(e,t){return n.Children.map(e,(function(e){return null===e?null:function(e){return Ar(e)||Ur(e)||Fr(e)}(e)?t(e):e.props&&e.props.children&&"object"==typeof e.props.children?Object(n.cloneElement)(e,function(e){for(var t=1;t<arguments.length;t++){var o=null!=arguments[t]?arguments[t]:{},r=Object.keys(o);"function"==typeof Object.getOwnPropertySymbols&&(r=r.concat(Object.getOwnPropertySymbols(o).filter((function(e){return Object.getOwnPropertyDescriptor(o,e).enumerable})))),r.forEach((function(t){Hr(e,t,o[t])}))}return e}({},e.props,{children:Wr(e.props.children,t)})):e}))}function Vr(e,t){return n.Children.forEach(e,(function(e){null!==e&&(Ar(e)||Fr(e)?t(e):e.props&&e.props.children&&"object"==typeof e.props.children&&(Ur(e)&&t(e),Vr(e.props.children,t)))}))}var Kr,Gr=o(33),Yr=o.n(Gr),Zr=0;function Xr(){return"react-tabs-"+Zr++}function Jr(e){var t=0;return Vr(e,(function(e){Ar(e)&&t++})),t}function Qr(){return(Qr=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var o=arguments[t];for(var r in o)Object.prototype.hasOwnProperty.call(o,r)&&(e[r]=o[r])}return e}).apply(this,arguments)}function en(e){return e&&"getAttribute"in e}function tn(e){return en(e)&&"tab"===e.getAttribute("role")}function on(e){return en(e)&&"true"===e.getAttribute("aria-disabled")}try{Kr=!("undefined"==typeof window||!window.document||!window.document.activeElement)}catch(e){Kr=!1}var rn=function(e){var t,o;function r(){for(var t,o=arguments.length,r=new Array(o),n=0;n<o;n++)r[n]=arguments[n];return(t=e.call.apply(e,[this].concat(r))||this).tabNodes=[],t.handleKeyDown=function(e){if(t.isTabFromContainer(e.target)){var o=t.props.selectedIndex,r=!1,n=!1;32!==e.keyCode&&13!==e.keyCode||(r=!0,n=!1,t.handleClick(e)),37===e.keyCode||38===e.keyCode?(o=t.getPrevTab(o),r=!0,n=!0):39===e.keyCode||40===e.keyCode?(o=t.getNextTab(o),r=!0,n=!0):35===e.keyCode?(o=t.getLastTab(),r=!0,n=!0):36===e.keyCode&&(o=t.getFirstTab(),r=!0,n=!0),r&&e.preventDefault(),n&&t.setSelected(o,e)}},t.handleClick=function(e){var o=e.target;do{if(t.isTabFromContainer(o)){if(on(o))return;var r=[].slice.call(o.parentNode.children).filter(tn).indexOf(o);return void t.setSelected(r,e)}}while(null!=(o=o.parentNode))},t}o=e,(t=r).prototype=Object.create(o.prototype),t.prototype.constructor=t,t.__proto__=o;var s=r.prototype;return s.setSelected=function(e,t){if(!(e<0||e>=this.getTabsCount())){var o=this.props;(0,o.onSelect)(e,o.selectedIndex,t)}},s.getNextTab=function(e){for(var t=this.getTabsCount(),o=e+1;o<t;o++)if(!on(this.getTab(o)))return o;for(var r=0;r<e;r++)if(!on(this.getTab(r)))return r;return e},s.getPrevTab=function(e){for(var t=e;t--;)if(!on(this.getTab(t)))return t;for(t=this.getTabsCount();t-- >e;)if(!on(this.getTab(t)))return t;return e},s.getFirstTab=function(){for(var e=this.getTabsCount(),t=0;t<e;t++)if(!on(this.getTab(t)))return t;return null},s.getLastTab=function(){for(var e=this.getTabsCount();e--;)if(!on(this.getTab(e)))return e;return null},s.getTabsCount=function(){return Jr(this.props.children)},s.getPanelsCount=function(){return e=this.props.children,t=0,Vr(e,(function(e){Fr(e)&&t++})),t;var e,t},s.getTab=function(e){return this.tabNodes["tabs-"+e]},s.getChildren=function(){var e=this,t=0,o=this.props,r=o.children,s=o.disabledTabClassName,l=o.focus,i=o.forceRenderTabPanel,c=o.selectedIndex,d=o.selectedTabClassName,u=o.selectedTabPanelClassName;this.tabIds=this.tabIds||[],this.panelIds=this.panelIds||[];for(var p=this.tabIds.length-this.getTabsCount();p++<0;)this.tabIds.push(Xr()),this.panelIds.push(Xr());return Wr(r,(function(o){var r=o;if(Ur(o)){var p=0,h=!1;Kr&&(h=a.a.Children.toArray(o.props.children).filter(Ar).some((function(t,o){return document.activeElement===e.getTab(o)}))),r=Object(n.cloneElement)(o,{children:Wr(o.props.children,(function(t){var o="tabs-"+p,r=c===p,a={tabRef:function(t){e.tabNodes[o]=t},id:e.tabIds[p],panelId:e.panelIds[p],selected:r,focus:r&&(l||h)};return d&&(a.selectedClassName=d),s&&(a.disabledClassName=s),p++,Object(n.cloneElement)(t,a)}))})}else if(Fr(o)){var f={id:e.panelIds[t],tabId:e.tabIds[t],selected:c===t};i&&(f.forceRender=i),u&&(f.selectedClassName=u),t++,r=Object(n.cloneElement)(o,f)}return r}))},s.isTabFromContainer=function(e){if(!tn(e))return!1;var t=e.parentElement;do{if(t===this.node)return!0;if(t.getAttribute("data-tabs"))break;t=t.parentElement}while(t);return!1},s.render=function(){var e=this,t=this.props,o=(t.children,t.className),r=(t.disabledTabClassName,t.domRef),n=(t.focus,t.forceRenderTabPanel,t.onSelect,t.selectedIndex,t.selectedTabClassName,t.selectedTabPanelClassName,function(e,t){if(null==e)return{};var o,r,n={},a=Object.keys(e);for(r=0;r<a.length;r++)o=a[r],t.indexOf(o)>=0||(n[o]=e[o]);return n}(t,["children","className","disabledTabClassName","domRef","focus","forceRenderTabPanel","onSelect","selectedIndex","selectedTabClassName","selectedTabPanelClassName"]));return a.a.createElement("div",Qr({},n,{className:Yr()(o),onClick:this.handleClick,onKeyDown:this.handleKeyDown,ref:function(t){e.node=t,r&&r(t)},"data-tabs":!0}),this.getChildren())},r}(n.Component);rn.defaultProps={className:"react-tabs",focus:!1},rn.propTypes={};var nn=function(e){var t,o;function r(t){var o;return(o=e.call(this,t)||this).handleSelected=function(e,t,n){var a=o.props.onSelect;if("function"!=typeof a||!1!==a(e,t,n)){var s={focus:"keydown"===n.type};r.inUncontrolledMode(o.props)&&(s.selectedIndex=e),o.setState(s)}},o.state=r.copyPropsToState(o.props,{},t.defaultFocus),o}o=e,(t=r).prototype=Object.create(o.prototype),t.prototype.constructor=t,t.__proto__=o;var n=r.prototype;return n.componentWillReceiveProps=function(e){this.setState((function(t){return r.copyPropsToState(e,t)}))},r.inUncontrolledMode=function(e){return null===e.selectedIndex},r.copyPropsToState=function(e,t,o){void 0===o&&(o=!1);var n={focus:o};if(r.inUncontrolledMode(e)){var a,s=Jr(e.children)-1;a=null!=t.selectedIndex?Math.min(t.selectedIndex,s):e.defaultIndex||0,n.selectedIndex=a}return n},n.render=function(){var e=this.props,t=e.children,o=(e.defaultIndex,e.defaultFocus,function(e,t){if(null==e)return{};var o,r,n={},a=Object.keys(e);for(r=0;r<a.length;r++)o=a[r],t.indexOf(o)>=0||(n[o]=e[o]);return n}(e,["children","defaultIndex","defaultFocus"])),r=this.state,n=r.focus,s=r.selectedIndex;return o.focus=n,o.onSelect=this.handleSelected,null!=s&&(o.selectedIndex=s),a.a.createElement(rn,o,t)},r}(n.Component);function an(){return(an=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var o=arguments[t];for(var r in o)Object.prototype.hasOwnProperty.call(o,r)&&(e[r]=o[r])}return e}).apply(this,arguments)}nn.defaultProps={defaultFocus:!1,forceRenderTabPanel:!1,selectedIndex:null,defaultIndex:null},nn.propTypes={},nn.tabsRole="Tabs";var sn=function(e){var t,o;function r(){return e.apply(this,arguments)||this}return o=e,(t=r).prototype=Object.create(o.prototype),t.prototype.constructor=t,t.__proto__=o,r.prototype.render=function(){var e=this.props,t=e.children,o=e.className,r=function(e,t){if(null==e)return{};var o,r,n={},a=Object.keys(e);for(r=0;r<a.length;r++)o=a[r],t.indexOf(o)>=0||(n[o]=e[o]);return n}(e,["children","className"]);return a.a.createElement("ul",an({},r,{className:Yr()(o),role:"tablist"}),t)},r}(n.Component);function ln(){return(ln=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var o=arguments[t];for(var r in o)Object.prototype.hasOwnProperty.call(o,r)&&(e[r]=o[r])}return e}).apply(this,arguments)}sn.defaultProps={className:"react-tabs__tab-list"},sn.propTypes={},sn.tabsRole="TabList";var cn=function(e){var t,o;function r(){return e.apply(this,arguments)||this}o=e,(t=r).prototype=Object.create(o.prototype),t.prototype.constructor=t,t.__proto__=o;var n=r.prototype;return n.componentDidMount=function(){this.checkFocus()},n.componentDidUpdate=function(){this.checkFocus()},n.checkFocus=function(){var e=this.props,t=e.selected,o=e.focus;t&&o&&this.node.focus()},n.render=function(){var e,t=this,o=this.props,r=o.children,n=o.className,s=o.disabled,l=o.disabledClassName,i=(o.focus,o.id),c=o.panelId,d=o.selected,u=o.selectedClassName,p=o.tabIndex,h=o.tabRef,f=function(e,t){if(null==e)return{};var o,r,n={},a=Object.keys(e);for(r=0;r<a.length;r++)o=a[r],t.indexOf(o)>=0||(n[o]=e[o]);return n}(o,["children","className","disabled","disabledClassName","focus","id","panelId","selected","selectedClassName","tabIndex","tabRef"]);return a.a.createElement("li",ln({},f,{className:Yr()(n,(e={},e[u]=d,e[l]=s,e)),ref:function(e){t.node=e,h&&h(e)},role:"tab",id:i,"aria-selected":d?"true":"false","aria-disabled":s?"true":"false","aria-controls":c,tabIndex:p||(d?"0":null)}),r)},r}(n.Component);function dn(){return(dn=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var o=arguments[t];for(var r in o)Object.prototype.hasOwnProperty.call(o,r)&&(e[r]=o[r])}return e}).apply(this,arguments)}cn.defaultProps={className:"react-tabs__tab",disabledClassName:"react-tabs__tab--disabled",focus:!1,id:null,panelId:null,selected:!1,selectedClassName:"react-tabs__tab--selected"},cn.propTypes={},cn.tabsRole="Tab";var un=function(e){var t,o;function r(){return e.apply(this,arguments)||this}return o=e,(t=r).prototype=Object.create(o.prototype),t.prototype.constructor=t,t.__proto__=o,r.prototype.render=function(){var e,t=this.props,o=t.children,r=t.className,n=t.forceRender,s=t.id,l=t.selected,i=t.selectedClassName,c=t.tabId,d=function(e,t){if(null==e)return{};var o,r,n={},a=Object.keys(e);for(r=0;r<a.length;r++)o=a[r],t.indexOf(o)>=0||(n[o]=e[o]);return n}(t,["children","className","forceRender","id","selected","selectedClassName","tabId"]);return a.a.createElement("div",dn({},d,{className:Yr()(r,(e={},e[i]=l,e)),role:"tabpanel",id:s,"aria-labelledby":c}),n||l?o:null)},r}(n.Component);un.defaultProps={className:"react-tabs__tab-panel",forceRender:!1,selectedClassName:"react-tabs__tab-panel--selected"},un.propTypes={},un.tabsRole="TabPanel";const pn=c.a.div`
	font-size: 1em;

	.react-tabs__tab-list {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		list-style: none;
		padding: 0;
		margin: 0;
		border-bottom: 4px solid ${d.colors.$color_grey_light};
	}

	.react-tabs__tab {
		flex: 0 1 ${e=>e.tabsBaseWidth};
		text-align: center;
		margin: 0 16px;
		padding: 16px 0;
		cursor: pointer;
		font-family: "Open Sans", sans-serif;
		font-size: ${e=>e.tabsFontSize};
		line-height: 1.33333333;
		font-weight: ${e=>e.tabsFontWeight};
		color: ${e=>e.tabsTextColor};
		text-transform: ${e=>e.tabsTextTransform};

		&.react-tabs__tab--selected {
			box-shadow: 0 4px 0 0 ${d.colors.$color_pink_dark};
		}
	}

	.react-tabs__tab-panel {
		display: none;
		padding: 24px 40px;

		@media screen and ( max-width: ${d.breakpoints.mobile} ) {
			padding: 16px 16px;
		}

		:focus {
			outline: none;
		}

		&.react-tabs__tab-panel--selected {
			display: block;
		}
	}
`;pn.propTypes={tabsTextColor:l.a.string,tabsTextTransform:l.a.string,tabsFontSize:l.a.string,tabsFontWeight:l.a.string,tabsBaseWidth:l.a.string};class hn extends a.a.Component{getTabs(){return this.props.items.map(e=>Object(r.createElement)(cn,{key:e.id},e.label))}getTabPanels(){return this.props.items.map(e=>Object(r.createElement)(un,{key:e.id,tabIndex:"0"},e.content))}render(){return Object(r.createElement)(pn,{tabsTextColor:this.props.tabsTextColor,tabsTextTransform:this.props.tabsTextTransform,tabsFontSize:this.props.tabsFontSize,tabsFontWeight:this.props.tabsFontWeight,tabsBaseWidth:this.props.tabsBaseWidth},Object(r.createElement)(nn,{onSelect:this.props.onTabSelect},Object(r.createElement)(sn,null,this.getTabs()),this.getTabPanels()))}componentDidMount(){this.props.onTabsMounted()}}hn.propTypes={items:l.a.arrayOf(l.a.shape({id:l.a.string.isRequired,label:l.a.string.isRequired,content:l.a.object.isRequired})),tabsTextColor:l.a.string,tabsTextTransform:l.a.string,tabsFontSize:l.a.string,tabsFontWeight:l.a.string,tabsBaseWidth:l.a.string,onTabSelect:l.a.func,onTabsMounted:l.a.func},hn.defaultProps={items:[],tabsTextColor:d.colors.$color_grey_dark,tabsTextTransform:"none",tabsFontSize:"1.5em",tabsFontWeight:"200",tabsBaseWidth:"200px",onTabSelect:()=>{},onTabsMounted:()=>{}};var fn=hn,bn=o(81),mn=o.n(bn);const gn=c.a.div`
	display: flex;
	padding: 16px;
	background: ${d.colors.$color_alert_warning_background};
	color: ${d.colors.$color_alert_warning_text};
`,yn=c()(y)`
	margin-top: 2px;
`,vn=c.a.div`
	margin: ${Object(u.getDirectionalStyle)("0 0 0 8px","0 8px 0 0")};
`;class xn extends a.a.Component{render(){const{message:e}=this.props;return mn()(e)?null:Object(r.createElement)(gn,null,Object(r.createElement)(yn,{icon:"exclamation-triangle",size:"16px"}),Object(r.createElement)(vn,null,e))}}xn.propTypes={message:l.a.array},xn.defaultProps={message:[]};var On=xn;const Cn=c.a.div`
	position: relative;
	padding-bottom: 56.25%; /* 16:9 */
	height: 0;
	overflow: hidden;

	iframe {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	}
`;function wn(e){return Object(r.createElement)(Cn,null,Object(r.createElement)(io,e))}wn.propTypes={width:l.a.number,height:l.a.number,src:l.a.string.isRequired,title:l.a.string.isRequired,frameBorder:l.a.number,allowFullScreen:l.a.bool},wn.defaultProps={width:560,height:315,frameBorder:0,allowFullScreen:!0};const jn=e=>{console.warn("The WordList component has been deprecated and will be removed in a future release.");const{title:t,classNamePrefix:o,words:n,header:a,footer:s}=e,l=Object(r.createElement)("ol",{className:o+"__list"},n.map(e=>Object(r.createElement)("li",{key:e,className:o+"__item"},e)));return Object(r.createElement)("div",{className:o},Object(r.createElement)("p",null,Object(r.createElement)("strong",null,t)),a,l,s)};jn.propTypes={words:l.a.array.isRequired,title:l.a.string.isRequired,header:l.a.string,footer:l.a.string,classNamePrefix:l.a.string},jn.defaultProps={classNamePrefix:"",header:"",footer:""};var En=jn;const kn=c.a.ul`
	margin: 0;
 	padding: 0;
 	list-style: none;
 	position: relative;
 	width: 100%;

 	li:first-child {
		& > span::before {
			left: auto;
		}
	}
`;kn.propTypes={children:l.a.any};class Sn extends a.a.Component{constructor(e){super(e)}getChildren(){return 1===this.props.children?[this.props.children]:this.props.children}render(){const e=this.getChildren();return Object(r.createElement)(kn,{role:"list"},e)}}class Tn extends Sn{constructor(e){super(e),this.zebraProps=Object.assign({},e)}zebrafyChildren(){let e=this.props.children;this.props.children.map||(e=[e]),this.zebraProps.children=e.map((e,t)=>a.a.cloneElement(e,{background:t%2==1?d.colors.$color_white:d.colors.$color_background_light,key:t}))}render(){return this.zebrafyChildren(),Object(r.createElement)(kn,B()({role:"list"},this.zebraProps))}}Sn.propTypes={children:l.a.oneOfType([l.a.arrayOf(l.a.node),l.a.node])},Sn.defaultProps={children:[]};const $n=c.a.li`
	background: ${e=>e.background};
	display: flex;
	min-height: ${e=>e.rowHeight};
	align-items: center;
	justify-content: space-between;
`;$n.propTypes={background:l.a.string,hasHeaderLabels:l.a.bool,rowHeight:l.a.string},$n.defaultProps={background:d.colors.$color_white,hasHeaderLabels:!0},c()($n)`
	@media screen and ( max-width: 800px ) {
		flex-wrap: wrap;
		align-items: flex-start;

		&:first-child {
			margin-top: ${e=>e.hasHeaderLabels?"24px":"0"};
		}

		// Use the column headers (if any) as labels.
		& > span::before {
			position: static;
			display: inline-block;
			padding-right: 0.5em;
			font-size: inherit;
		}
		& > span {
			padding-left: 0;
		}
	}
`;class qn extends a.a.Component{constructor(){super(),this.focus=this.focus.bind(this),this.blur=this.blur.bind(this),this.state={focused:!1}}focus(){this.setState({focused:!0})}blur(){this.setState({focused:!1})}getStyles(){return!0===this.state.focused?Ye.ScreenReaderText.focused:Ye.ScreenReaderText.default}render(){return Object(r.createElement)("a",{href:"#"+this.props.anchor,className:"screen-reader-shortcut",style:this.getStyles(),onFocus:this.focus,onBlur:this.blur},this.props.children)}}qn.propTypes={anchor:l.a.string.isRequired,children:l.a.string.isRequired};var Nn=qn},5:function(e,t){e.exports=window.yoast.styledComponents},6:function(e,t){e.exports=window.yoast.styleGuide},65:function(e,t,o){"use strict";var r=o(3),n="function"==typeof Symbol&&Symbol.for&&Symbol.for("react.element")||60103,a=o(41),s=o(66),l=o(67),i="function"==typeof Symbol&&Symbol.iterator;function c(e,t){return e&&"object"==typeof e&&null!=e.key?(o=e.key,r={"=":"=0",":":"=2"},"$"+(""+o).replace(/[=:]/g,(function(e){return r[e]}))):t.toString(36);var o,r}var d=/\/+/g;function u(e){return(""+e).replace(d,"$&/")}var p,h,f=b,b=function(e){if(this.instancePool.length){var t=this.instancePool.pop();return this.call(t,e),t}return new this(e)};function m(e,t,o,r){this.result=e,this.keyPrefix=t,this.func=o,this.context=r,this.count=0}function g(e,t,o){var n,s,l=e.result,i=e.keyPrefix,c=e.func,d=e.context,p=c.call(d,t,e.count++);Array.isArray(p)?y(p,l,o,a.thatReturnsArgument):null!=p&&(r.isValidElement(p)&&(n=p,s=i+(!p.key||t&&t.key===p.key?"":u(p.key)+"/")+o,p=r.cloneElement(n,{key:s},void 0!==n.props?n.props.children:void 0)),l.push(p))}function y(e,t,o,r,a){var l="";null!=o&&(l=u(o)+"/");var d=m.getPooled(t,l,r,a);!function(e,t,o){null==e||function e(t,o,r,a){var l,d=typeof t;if("undefined"!==d&&"boolean"!==d||(t=null),null===t||"string"===d||"number"===d||"object"===d&&t.$$typeof===n)return r(a,t,""===o?"."+c(t,0):o),1;var u=0,p=""===o?".":o+":";if(Array.isArray(t))for(var h=0;h<t.length;h++)u+=e(l=t[h],p+c(l,h),r,a);else{var f=function(e){var t=e&&(i&&e[i]||e["@@iterator"]);if("function"==typeof t)return t}(t);if(f)for(var b,m=f.call(t),g=0;!(b=m.next()).done;)u+=e(l=b.value,p+c(l,g++),r,a);else if("object"===d){var y=""+t;s(!1,"Objects are not valid as a React child (found: %s).%s","[object Object]"===y?"object with keys {"+Object.keys(t).join(", ")+"}":y,"")}}return u}(e,"",t,o)}(e,g,d),m.release(d)}m.prototype.destructor=function(){this.result=null,this.keyPrefix=null,this.func=null,this.context=null,this.count=0},p=function(e,t,o,r){if(this.instancePool.length){var n=this.instancePool.pop();return this.call(n,e,t,o,r),n}return new this(e,t,o,r)},(h=m).instancePool=[],h.getPooled=p||f,h.poolSize||(h.poolSize=10),h.release=function(e){s(e instanceof this,"Trying to release an instance into a pool of a different type."),e.destructor(),this.instancePool.length<this.poolSize&&this.instancePool.push(e)},e.exports=function(e){if("object"!=typeof e||!e||Array.isArray(e))return l(!1,"React.addons.createFragment only accepts a single object. Got: %s",e),e;if(r.isValidElement(e))return l(!1,"React.addons.createFragment does not accept a ReactElement without a wrapper object."),e;s(1!==e.nodeType,"React.addons.createFragment(...): Encountered an invalid child; DOM elements are not valid children of React components.");var t=[];for(var o in e)y(e[o],t,o,a.thatReturnsArgument);return t}},66:function(e,t,o){"use strict";e.exports=function(e,t,o,r,n,a,s,l){if(!e){var i;if(void 0===t)i=new Error("Minified exception occurred; use the non-minified dev environment for the full error message and additional helpful warnings.");else{var c=[o,r,n,a,s,l],d=0;(i=new Error(t.replace(/%s/g,(function(){return c[d++]})))).name="Invariant Violation"}throw i.framesToPop=1,i}}},67:function(e,t,o){"use strict";var r=o(41);e.exports=r},68:function(e,t,o){"use strict";function r(e){return e.match(/^\{\{\//)?{type:"componentClose",value:e.replace(/\W/g,"")}:e.match(/\/\}\}$/)?{type:"componentSelfClosing",value:e.replace(/\W/g,"")}:e.match(/^\{\{/)?{type:"componentOpen",value:e.replace(/\W/g,"")}:{type:"string",value:e}}e.exports=function(e){return e.split(/(\{\{\/?\s*\w+\s*\/?\}\})/g).map(r)}},81:function(e,t){e.exports=window.lodash.isEmpty},86:function(e,t,o){"use strict";function r(){var e=this.constructor.getDerivedStateFromProps(this.props,this.state);null!=e&&this.setState(e)}function n(e){this.setState(function(t){var o=this.constructor.getDerivedStateFromProps(e,t);return null!=o?o:null}.bind(this))}function a(e,t){try{var o=this.props,r=this.state;this.props=e,this.state=t,this.__reactInternalSnapshotFlag=!0,this.__reactInternalSnapshot=this.getSnapshotBeforeUpdate(o,r)}finally{this.props=o,this.state=r}}function s(e){var t=e.prototype;if(!t||!t.isReactComponent)throw new Error("Can only polyfill class components");if("function"!=typeof e.getDerivedStateFromProps&&"function"!=typeof t.getSnapshotBeforeUpdate)return e;var o=null,s=null,l=null;if("function"==typeof t.componentWillMount?o="componentWillMount":"function"==typeof t.UNSAFE_componentWillMount&&(o="UNSAFE_componentWillMount"),"function"==typeof t.componentWillReceiveProps?s="componentWillReceiveProps":"function"==typeof t.UNSAFE_componentWillReceiveProps&&(s="UNSAFE_componentWillReceiveProps"),"function"==typeof t.componentWillUpdate?l="componentWillUpdate":"function"==typeof t.UNSAFE_componentWillUpdate&&(l="UNSAFE_componentWillUpdate"),null!==o||null!==s||null!==l){var i=e.displayName||e.name,c="function"==typeof e.getDerivedStateFromProps?"getDerivedStateFromProps()":"getSnapshotBeforeUpdate()";throw Error("Unsafe legacy lifecycles will not be called for components using new component APIs.\n\n"+i+" uses "+c+" but also contains the following legacy lifecycles:"+(null!==o?"\n  "+o:"")+(null!==s?"\n  "+s:"")+(null!==l?"\n  "+l:"")+"\n\nThe above lifecycles should be removed. Learn more about this warning here:\nhttps://fb.me/react-async-component-lifecycle-hooks")}if("function"==typeof e.getDerivedStateFromProps&&(t.componentWillMount=r,t.componentWillReceiveProps=n),"function"==typeof t.getSnapshotBeforeUpdate){if("function"!=typeof t.componentDidUpdate)throw new Error("Cannot polyfill getSnapshotBeforeUpdate() for components that do not define componentDidUpdate() on the prototype");t.componentWillUpdate=a;var d=t.componentDidUpdate;t.componentDidUpdate=function(e,t,o){var r=this.__reactInternalSnapshotFlag?this.__reactInternalSnapshot:o;d.call(this,e,t,r)}}return e}o.r(t),o.d(t,"polyfill",(function(){return s})),r.__suppressDeprecationWarning=!0,n.__suppressDeprecationWarning=!0,a.__suppressDeprecationWarning=!0},9:function(e,t){e.exports=window.yoast.helpers}});