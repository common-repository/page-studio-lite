define("ace/mode/css_highlight_rules",["require","exports","module","ace/lib/oop","ace/lib/lang","ace/mode/text_highlight_rules"],function(e,t,r){"use strict";var n=e("../lib/oop"),o=(e("../lib/lang"),e("./text_highlight_rules").TextHighlightRules),i=t.supportType="align-content|align-items|align-self|all|animation|animation-delay|animation-direction|animation-duration|animation-fill-mode|animation-iteration-count|animation-name|animation-play-state|animation-timing-function|backface-visibility|background|background-attachment|background-blend-mode|background-clip|background-color|background-image|background-origin|background-position|background-repeat|background-size|border|border-bottom|border-bottom-color|border-bottom-left-radius|border-bottom-right-radius|border-bottom-style|border-bottom-width|border-collapse|border-color|border-image|border-image-outset|border-image-repeat|border-image-slice|border-image-source|border-image-width|border-left|border-left-color|border-left-style|border-left-width|border-radius|border-right|border-right-color|border-right-style|border-right-width|border-spacing|border-style|border-top|border-top-color|border-top-left-radius|border-top-right-radius|border-top-style|border-top-width|border-width|bottom|box-shadow|box-sizing|caption-side|clear|clip|color|column-count|column-fill|column-gap|column-rule|column-rule-color|column-rule-style|column-rule-width|column-span|column-width|columns|content|counter-increment|counter-reset|cursor|direction|display|empty-cells|filter|flex|flex-basis|flex-direction|flex-flow|flex-grow|flex-shrink|flex-wrap|float|font|font-family|font-size|font-size-adjust|font-stretch|font-style|font-variant|font-weight|hanging-punctuation|height|justify-content|left|letter-spacing|line-height|list-style|list-style-image|list-style-position|list-style-type|margin|margin-bottom|margin-left|margin-right|margin-top|max-height|max-width|min-height|min-width|nav-down|nav-index|nav-left|nav-right|nav-up|opacity|order|outline|outline-color|outline-offset|outline-style|outline-width|overflow|overflow-x|overflow-y|padding|padding-bottom|padding-left|padding-right|padding-top|page-break-after|page-break-before|page-break-inside|perspective|perspective-origin|position|quotes|resize|right|tab-size|table-layout|text-align|text-align-last|text-decoration|text-decoration-color|text-decoration-line|text-decoration-style|text-indent|text-justify|text-overflow|text-shadow|text-transform|top|transform|transform-origin|transform-style|transition|transition-delay|transition-duration|transition-property|transition-timing-function|unicode-bidi|vertical-align|visibility|white-space|width|word-break|word-spacing|word-wrap|z-index",a=t.supportFunction="rgb|rgba|url|attr|counter|counters",s=t.supportConstant="absolute|after-edge|after|all-scroll|all|alphabetic|always|antialiased|armenian|auto|avoid-column|avoid-page|avoid|balance|baseline|before-edge|before|below|bidi-override|block-line-height|block|bold|bolder|border-box|both|bottom|box|break-all|break-word|capitalize|caps-height|caption|center|central|char|circle|cjk-ideographic|clone|close-quote|col-resize|collapse|column|consider-shifts|contain|content-box|cover|crosshair|cubic-bezier|dashed|decimal-leading-zero|decimal|default|disabled|disc|disregard-shifts|distribute-all-lines|distribute-letter|distribute-space|distribute|dotted|double|e-resize|ease-in|ease-in-out|ease-out|ease|ellipsis|end|exclude-ruby|fill|fixed|georgian|glyphs|grid-height|groove|hand|hanging|hebrew|help|hidden|hiragana-iroha|hiragana|horizontal|icon|ideograph-alpha|ideograph-numeric|ideograph-parenthesis|ideograph-space|ideographic|inactive|include-ruby|inherit|initial|inline-block|inline-box|inline-line-height|inline-table|inline|inset|inside|inter-ideograph|inter-word|invert|italic|justify|katakana-iroha|katakana|keep-all|last|left|lighter|line-edge|line-through|line|linear|list-item|local|loose|lower-alpha|lower-greek|lower-latin|lower-roman|lowercase|lr-tb|ltr|mathematical|max-height|max-size|medium|menu|message-box|middle|move|n-resize|ne-resize|newspaper|no-change|no-close-quote|no-drop|no-open-quote|no-repeat|none|normal|not-allowed|nowrap|nw-resize|oblique|open-quote|outset|outside|overline|padding-box|page|pointer|pre-line|pre-wrap|pre|preserve-3d|progress|relative|repeat-x|repeat-y|repeat|replaced|reset-size|ridge|right|round|row-resize|rtl|s-resize|scroll|se-resize|separate|slice|small-caps|small-caption|solid|space|square|start|static|status-bar|step-end|step-start|steps|stretch|strict|sub|super|sw-resize|table-caption|table-cell|table-column-group|table-column|table-footer-group|table-header-group|table-row-group|table-row|table|tb-rl|text-after-edge|text-before-edge|text-bottom|text-size|text-top|text|thick|thin|transparent|underline|upper-alpha|upper-latin|upper-roman|uppercase|use-script|vertical-ideographic|vertical-text|visible|w-resize|wait|whitespace|z-index|zero",l=t.supportConstantColor="aqua|black|blue|fuchsia|gray|green|lime|maroon|navy|olive|orange|purple|red|silver|teal|white|yellow",c=t.supportConstantFonts="arial|century|comic|courier|cursive|fantasy|garamond|georgia|helvetica|impact|lucida|symbol|system|tahoma|times|trebuchet|utopia|verdana|webdings|sans-serif|serif|monospace",u=t.numRe="\\-?(?:(?:[0-9]+)|(?:[0-9]*\\.[0-9]+))",d=t.pseudoElements="(\\:+)\\b(after|before|first-letter|first-line|moz-selection|selection)\\b",g=t.pseudoClasses="(:)\\b(active|checked|disabled|empty|enabled|first-child|first-of-type|focus|hover|indeterminate|invalid|last-child|last-of-type|link|not|nth-child|nth-last-child|nth-last-of-type|nth-of-type|only-child|only-of-type|required|root|target|valid|visited)\\b",p=function(){var e=this.createKeywordMapper({"support.function":a,"support.constant":s,"support.type":i,"support.constant.color":l,"support.constant.fonts":c},"text",!0);this.$rules={start:[{token:"comment",regex:"\\/\\*",push:"comment"},{token:"paren.lparen",regex:"\\{",push:"ruleset"},{token:"string",regex:"@.*?{",push:"media"},{token:"keyword",regex:"#[a-z0-9-_]+"},{token:"variable",regex:"\\.[a-z0-9-_]+"},{token:"string",regex:":[a-z0-9-_]+"},{token:"constant",regex:"[a-z0-9-_]+"},{caseInsensitive:!0}],media:[{token:"comment",regex:"\\/\\*",push:"comment"},{token:"paren.lparen",regex:"\\{",push:"ruleset"},{token:"string",regex:"\\}",next:"pop"},{token:"keyword",regex:"#[a-z0-9-_]+"},{token:"variable",regex:"\\.[a-z0-9-_]+"},{token:"string",regex:":[a-z0-9-_]+"},{token:"constant",regex:"[a-z0-9-_]+"},{caseInsensitive:!0}],comment:[{token:"comment",regex:"\\*\\/",next:"pop"},{defaultToken:"comment"}],ruleset:[{token:"paren.rparen",regex:"\\}",next:"pop"},{token:"comment",regex:"\\/\\*",push:"comment"},{token:"string",regex:'["](?:(?:\\\\.)|(?:[^"\\\\]))*?["]'},{token:"string",regex:"['](?:(?:\\\\.)|(?:[^'\\\\]))*?[']"},{token:["constant.numeric","keyword"],regex:"("+u+")(ch|cm|deg|em|ex|fr|gd|grad|Hz|in|kHz|mm|ms|pc|pt|px|rad|rem|s|turn|vh|vm|vw|%)"},{token:"constant.numeric",regex:u},{token:"constant.numeric",regex:"#[a-f0-9]{6}"},{token:"constant.numeric",regex:"#[a-f0-9]{3}"},{token:["punctuation","entity.other.attribute-name.pseudo-element.css"],regex:d},{token:["punctuation","entity.other.attribute-name.pseudo-class.css"],regex:g},{token:["support.function","string","support.function"],regex:"(url\\()(.*)(\\))"},{token:e,regex:"\\-?[a-zA-Z_][a-zA-Z0-9_\\-]*"},{caseInsensitive:!0}]},this.normalizeRules()};n.inherits(p,o),t.CssHighlightRules=p}),define("ace/mode/matching_brace_outdent",["require","exports","module","ace/range"],function(e,t,r){"use strict";var n=e("../range").Range,o=function(){};(function(){this.checkOutdent=function(e,t){return/^\s+$/.test(e)?/^\s*\}/.test(t):!1},this.autoOutdent=function(e,t){var r=e.getLine(t),o=r.match(/^(\s*\})/);if(!o)return 0;var i=o[1].length,a=e.findMatchingBracket({row:t,column:i});if(!a||a.row==t)return 0;var s=this.$getIndent(e.getLine(a.row));e.replace(new n(t,0,t,i-1),s)},this.$getIndent=function(e){return e.match(/^\s*/)[0]}}).call(o.prototype),t.MatchingBraceOutdent=o}),define("ace/mode/css_completions",["require","exports","module"],function(e,t,r){"use strict";var n={background:{"#$0":1},"background-color":{"#$0":1,transparent:1,fixed:1},"background-image":{"url('/$0')":1},"background-repeat":{repeat:1,"repeat-x":1,"repeat-y":1,"no-repeat":1,inherit:1},"background-position":{bottom:2,center:2,left:2,right:2,top:2,inherit:2},"background-attachment":{scroll:1,fixed:1},"background-size":{cover:1,contain:1},"background-clip":{"border-box":1,"padding-box":1,"content-box":1},"background-origin":{"border-box":1,"padding-box":1,"content-box":1},border:{"solid $0":1,"dashed $0":1,"dotted $0":1,"#$0":1},"border-color":{"#$0":1},"border-style":{solid:2,dashed:2,dotted:2,"double":2,groove:2,hidden:2,inherit:2,inset:2,none:2,outset:2,ridged:2},"border-collapse":{collapse:1,separate:1},bottom:{px:1,em:1,"%":1},clear:{left:1,right:1,both:1,none:1},color:{"#$0":1,"rgb(#$00,0,0)":1},cursor:{"default":1,pointer:1,move:1,text:1,wait:1,help:1,progress:1,"n-resize":1,"ne-resize":1,"e-resize":1,"se-resize":1,"s-resize":1,"sw-resize":1,"w-resize":1,"nw-resize":1},display:{none:1,block:1,inline:1,"inline-block":1,"table-cell":1},"empty-cells":{show:1,hide:1},"float":{left:1,right:1,none:1},"font-family":{Arial:2,"Comic Sans MS":2,Consolas:2,"Courier New":2,Courier:2,Georgia:2,Monospace:2,"Sans-Serif":2,"Segoe UI":2,Tahoma:2,"Times New Roman":2,"Trebuchet MS":2,Verdana:1},"font-size":{px:1,em:1,"%":1},"font-weight":{bold:1,normal:1},"font-style":{italic:1,normal:1},"font-variant":{normal:1,"small-caps":1},height:{px:1,em:1,"%":1},left:{px:1,em:1,"%":1},"letter-spacing":{normal:1},"line-height":{normal:1},"list-style-type":{none:1,disc:1,circle:1,square:1,decimal:1,"decimal-leading-zero":1,"lower-roman":1,"upper-roman":1,"lower-greek":1,"lower-latin":1,"upper-latin":1,georgian:1,"lower-alpha":1,"upper-alpha":1},margin:{px:1,em:1,"%":1},"margin-right":{px:1,em:1,"%":1},"margin-left":{px:1,em:1,"%":1},"margin-top":{px:1,em:1,"%":1},"margin-bottom":{px:1,em:1,"%":1},"max-height":{px:1,em:1,"%":1},"max-width":{px:1,em:1,"%":1},"min-height":{px:1,em:1,"%":1},"min-width":{px:1,em:1,"%":1},overflow:{hidden:1,visible:1,auto:1,scroll:1},"overflow-x":{hidden:1,visible:1,auto:1,scroll:1},"overflow-y":{hidden:1,visible:1,auto:1,scroll:1},padding:{px:1,em:1,"%":1},"padding-top":{px:1,em:1,"%":1},"padding-right":{px:1,em:1,"%":1},"padding-bottom":{px:1,em:1,"%":1},"padding-left":{px:1,em:1,"%":1},"page-break-after":{auto:1,always:1,avoid:1,left:1,right:1},"page-break-before":{auto:1,always:1,avoid:1,left:1,right:1},position:{absolute:1,relative:1,fixed:1,"static":1},right:{px:1,em:1,"%":1},"table-layout":{fixed:1,auto:1},"text-decoration":{none:1,underline:1,"line-through":1,blink:1},"text-align":{left:1,right:1,center:1,justify:1},"text-transform":{capitalize:1,uppercase:1,lowercase:1,none:1},top:{px:1,em:1,"%":1},"vertical-align":{top:1,bottom:1},visibility:{hidden:1,visible:1},"white-space":{nowrap:1,normal:1,pre:1,"pre-line":1,"pre-wrap":1},width:{px:1,em:1,"%":1},"word-spacing":{normal:1},filter:{"alpha(opacity=$0100)":1},"text-shadow":{"$02px 2px 2px #777":1},"text-overflow":{"ellipsis-word":1,clip:1,ellipsis:1},"-moz-border-radius":1,"-moz-border-radius-topright":1,"-moz-border-radius-bottomright":1,"-moz-border-radius-topleft":1,"-moz-border-radius-bottomleft":1,"-webkit-border-radius":1,"-webkit-border-top-right-radius":1,"-webkit-border-top-left-radius":1,"-webkit-border-bottom-right-radius":1,"-webkit-border-bottom-left-radius":1,"-moz-box-shadow":1,"-webkit-box-shadow":1,transform:{"rotate($00deg)":1,"skew($00deg)":1},"-moz-transform":{"rotate($00deg)":1,"skew($00deg)":1},"-webkit-transform":{"rotate($00deg)":1,"skew($00deg)":1}},o=function(){};(function(){this.completionsDefined=!1,this.defineCompletions=function(){if(document){var e=document.createElement("c").style;for(var t in e)if("string"==typeof e[t]){var r=t.replace(/[A-Z]/g,function(e){return"-"+e.toLowerCase()});n.hasOwnProperty(r)||(n[r]=1)}}this.completionsDefined=!0},this.getCompletions=function(e,t,r,n){this.completionsDefined||this.defineCompletions();var o=t.getTokenAt(r.row,r.column);if(!o)return[];if("ruleset"===e){var i=t.getLine(r.row).substr(0,r.column);return/:[^;]+$/.test(i)?(/([\w\-]+):[^:]*$/.test(i),this.getPropertyValueCompletions(e,t,r,n)):this.getPropertyCompletions(e,t,r,n)}return[]},this.getPropertyCompletions=function(e,t,r,o){var i=Object.keys(n);return i.map(function(e){return{caption:e,snippet:e+": $0",meta:"property",score:Number.MAX_VALUE}})},this.getPropertyValueCompletions=function(e,t,r,o){var i=t.getLine(r.row).substr(0,r.column),a=(/([\w\-]+):[^:]*$/.exec(i)||{})[1];if(!a)return[];var s=[];return a in n&&"object"==typeof n[a]&&(s=Object.keys(n[a])),s.map(function(e){return{caption:e,snippet:e,meta:"property value",score:Number.MAX_VALUE}})}}).call(o.prototype),t.CssCompletions=o}),define("ace/mode/behaviour/cstyle",["require","exports","module","ace/lib/oop","ace/mode/behaviour","ace/token_iterator","ace/lib/lang"],function(e,t,r){"use strict";var n,o=e("../../lib/oop"),i=e("../behaviour").Behaviour,a=e("../../token_iterator").TokenIterator,s=e("../../lib/lang"),l=["text","paren.rparen","punctuation.operator"],c=["text","paren.rparen","punctuation.operator","comment"],u={},d=function(e){var t=-1;return e.multiSelect&&(t=e.selection.index,u.rangeCount!=e.multiSelect.rangeCount&&(u={rangeCount:e.multiSelect.rangeCount})),u[t]?n=u[t]:void(n=u[t]={autoInsertedBrackets:0,autoInsertedRow:-1,autoInsertedLineEnd:"",maybeInsertedBrackets:0,maybeInsertedRow:-1,maybeInsertedLineStart:"",maybeInsertedLineEnd:""})},g=function(e,t,r,n){var o=e.end.row-e.start.row;return{text:r+t+n,selection:[0,e.start.column+1,o,e.end.column+(o?0:1)]}},p=function(){this.add("braces","insertion",function(e,t,r,o,i){var a=r.getCursorPosition(),l=o.doc.getLine(a.row);if("{"==i){d(r);var c=r.getSelectionRange(),u=o.doc.getTextRange(c);if(""!==u&&"{"!==u&&r.getWrapBehavioursEnabled())return g(c,u,"{","}");if(p.isSaneInsertion(r,o))return/[\]\}\)]/.test(l[a.column])||r.inMultiSelectMode?(p.recordAutoInsert(r,o,"}"),{text:"{}",selection:[1,1]}):(p.recordMaybeInsert(r,o,"{"),{text:"{",selection:[1,1]})}else if("}"==i){d(r);var m=l.substring(a.column,a.column+1);if("}"==m){var h=o.$findOpeningBracket("}",{column:a.column+1,row:a.row});if(null!==h&&p.isAutoInsertedClosing(a,l,i))return p.popAutoInsertedClosing(),{text:"",selection:[1,1]}}}else{if("\n"==i||"\r\n"==i){d(r);var b="";p.isMaybeInsertedClosing(a,l)&&(b=s.stringRepeat("}",n.maybeInsertedBrackets),p.clearMaybeInsertedClosing());var m=l.substring(a.column,a.column+1);if("}"===m){var f=o.findMatchingBracket({row:a.row,column:a.column+1},"}");if(!f)return null;var w=this.$getIndent(o.getLine(f.row))}else{if(!b)return void p.clearMaybeInsertedClosing();var w=this.$getIndent(l)}var x=w+o.getTabString();return{text:"\n"+x+"\n"+w+b,selection:[1,x.length,1,x.length]}}p.clearMaybeInsertedClosing()}}),this.add("braces","deletion",function(e,t,r,o,i){var a=o.doc.getTextRange(i);if(!i.isMultiLine()&&"{"==a){d(r);var s=o.doc.getLine(i.start.row),l=s.substring(i.end.column,i.end.column+1);if("}"==l)return i.end.column++,i;n.maybeInsertedBrackets--}}),this.add("parens","insertion",function(e,t,r,n,o){if("("==o){d(r);var i=r.getSelectionRange(),a=n.doc.getTextRange(i);if(""!==a&&r.getWrapBehavioursEnabled())return g(i,a,"(",")");if(p.isSaneInsertion(r,n))return p.recordAutoInsert(r,n,")"),{text:"()",selection:[1,1]}}else if(")"==o){d(r);var s=r.getCursorPosition(),l=n.doc.getLine(s.row),c=l.substring(s.column,s.column+1);if(")"==c){var u=n.$findOpeningBracket(")",{column:s.column+1,row:s.row});if(null!==u&&p.isAutoInsertedClosing(s,l,o))return p.popAutoInsertedClosing(),{text:"",selection:[1,1]}}}}),this.add("parens","deletion",function(e,t,r,n,o){var i=n.doc.getTextRange(o);if(!o.isMultiLine()&&"("==i){d(r);var a=n.doc.getLine(o.start.row),s=a.substring(o.start.column+1,o.start.column+2);if(")"==s)return o.end.column++,o}}),this.add("brackets","insertion",function(e,t,r,n,o){if("["==o){d(r);var i=r.getSelectionRange(),a=n.doc.getTextRange(i);if(""!==a&&r.getWrapBehavioursEnabled())return g(i,a,"[","]");if(p.isSaneInsertion(r,n))return p.recordAutoInsert(r,n,"]"),{text:"[]",selection:[1,1]}}else if("]"==o){d(r);var s=r.getCursorPosition(),l=n.doc.getLine(s.row),c=l.substring(s.column,s.column+1);if("]"==c){var u=n.$findOpeningBracket("]",{column:s.column+1,row:s.row});if(null!==u&&p.isAutoInsertedClosing(s,l,o))return p.popAutoInsertedClosing(),{text:"",selection:[1,1]}}}}),this.add("brackets","deletion",function(e,t,r,n,o){var i=n.doc.getTextRange(o);if(!o.isMultiLine()&&"["==i){d(r);var a=n.doc.getLine(o.start.row),s=a.substring(o.start.column+1,o.start.column+2);if("]"==s)return o.end.column++,o}}),this.add("string_dquotes","insertion",function(e,t,r,n,o){if('"'==o||"'"==o){d(r);var i=o,a=r.getSelectionRange(),s=n.doc.getTextRange(a);if(""!==s&&"'"!==s&&'"'!=s&&r.getWrapBehavioursEnabled())return g(a,s,i,i);if(!s){var l=r.getCursorPosition(),c=n.doc.getLine(l.row),u=c.substring(l.column-1,l.column),p=c.substring(l.column,l.column+1),m=n.getTokenAt(l.row,l.column),h=n.getTokenAt(l.row,l.column+1);if("\\"==u&&m&&/escape/.test(m.type))return null;var b,f=m&&/string|escape/.test(m.type),w=!h||/string|escape/.test(h.type);if(p==i)b=f!==w;else{if(f&&!w)return null;if(f&&w)return null;var x=n.$mode.tokenRe;x.lastIndex=0;var v=x.test(u);x.lastIndex=0;var k=x.test(u);if(v||k)return null;if(p&&!/[\s;,.})\]\\]/.test(p))return null;b=!0}return{text:b?i+i:"",selection:[1,1]}}}}),this.add("string_dquotes","deletion",function(e,t,r,n,o){var i=n.doc.getTextRange(o);if(!o.isMultiLine()&&('"'==i||"'"==i)){d(r);var a=n.doc.getLine(o.start.row),s=a.substring(o.start.column+1,o.start.column+2);if(s==i)return o.end.column++,o}})};p.isSaneInsertion=function(e,t){var r=e.getCursorPosition(),n=new a(t,r.row,r.column);if(!this.$matchTokenType(n.getCurrentToken()||"text",l)){var o=new a(t,r.row,r.column+1);if(!this.$matchTokenType(o.getCurrentToken()||"text",l))return!1}return n.stepForward(),n.getCurrentTokenRow()!==r.row||this.$matchTokenType(n.getCurrentToken()||"text",c)},p.$matchTokenType=function(e,t){return t.indexOf(e.type||e)>-1},p.recordAutoInsert=function(e,t,r){var o=e.getCursorPosition(),i=t.doc.getLine(o.row);this.isAutoInsertedClosing(o,i,n.autoInsertedLineEnd[0])||(n.autoInsertedBrackets=0),n.autoInsertedRow=o.row,n.autoInsertedLineEnd=r+i.substr(o.column),n.autoInsertedBrackets++},p.recordMaybeInsert=function(e,t,r){var o=e.getCursorPosition(),i=t.doc.getLine(o.row);this.isMaybeInsertedClosing(o,i)||(n.maybeInsertedBrackets=0),n.maybeInsertedRow=o.row,n.maybeInsertedLineStart=i.substr(0,o.column)+r,n.maybeInsertedLineEnd=i.substr(o.column),n.maybeInsertedBrackets++},p.isAutoInsertedClosing=function(e,t,r){return n.autoInsertedBrackets>0&&e.row===n.autoInsertedRow&&r===n.autoInsertedLineEnd[0]&&t.substr(e.column)===n.autoInsertedLineEnd},p.isMaybeInsertedClosing=function(e,t){return n.maybeInsertedBrackets>0&&e.row===n.maybeInsertedRow&&t.substr(e.column)===n.maybeInsertedLineEnd&&t.substr(0,e.column)==n.maybeInsertedLineStart},p.popAutoInsertedClosing=function(){n.autoInsertedLineEnd=n.autoInsertedLineEnd.substr(1),n.autoInsertedBrackets--},p.clearMaybeInsertedClosing=function(){n&&(n.maybeInsertedBrackets=0,n.maybeInsertedRow=-1)},o.inherits(p,i),t.CstyleBehaviour=p}),define("ace/mode/behaviour/css",["require","exports","module","ace/lib/oop","ace/mode/behaviour","ace/mode/behaviour/cstyle","ace/token_iterator"],function(e,t,r){"use strict";var n=e("../../lib/oop"),o=(e("../behaviour").Behaviour,e("./cstyle").CstyleBehaviour),i=e("../../token_iterator").TokenIterator,a=function(){this.inherit(o),this.add("colon","insertion",function(e,t,r,n,o){if(":"===o){var a=r.getCursorPosition(),s=new i(n,a.row,a.column),l=s.getCurrentToken();if(l&&l.value.match(/\s+/)&&(l=s.stepBackward()),l&&"support.type"===l.type){var c=n.doc.getLine(a.row),u=c.substring(a.column,a.column+1);if(":"===u)return{text:"",selection:[1,1]};if(!c.substring(a.column).match(/^\s*;/))return{text:":;",selection:[1,1]}}}}),this.add("colon","deletion",function(e,t,r,n,o){var a=n.doc.getTextRange(o);if(!o.isMultiLine()&&":"===a){var s=r.getCursorPosition(),l=new i(n,s.row,s.column),c=l.getCurrentToken();if(c&&c.value.match(/\s+/)&&(c=l.stepBackward()),c&&"support.type"===c.type){var u=n.doc.getLine(o.start.row),d=u.substring(o.end.column,o.end.column+1);if(";"===d)return o.end.column++,o}}}),this.add("semicolon","insertion",function(e,t,r,n,o){if(";"===o){var i=r.getCursorPosition(),a=n.doc.getLine(i.row),s=a.substring(i.column,i.column+1);if(";"===s)return{text:"",selection:[1,1]}}})};n.inherits(a,o),t.CssBehaviour=a}),define("ace/mode/folding/cstyle",["require","exports","module","ace/lib/oop","ace/range","ace/mode/folding/fold_mode"],function(e,t,r){"use strict";var n=e("../../lib/oop"),o=e("../../range").Range,i=e("./fold_mode").FoldMode,a=t.FoldMode=function(e){e&&(this.foldingStartMarker=new RegExp(this.foldingStartMarker.source.replace(/\|[^|]*?$/,"|"+e.start)),this.foldingStopMarker=new RegExp(this.foldingStopMarker.source.replace(/\|[^|]*?$/,"|"+e.end)))};n.inherits(a,i),function(){this.foldingStartMarker=/(\{|\[)[^\}\]]*$|^\s*(\/\*)/,this.foldingStopMarker=/^[^\[\{]*(\}|\])|^[\s\*]*(\*\/)/,this.singleLineBlockCommentRe=/^\s*(\/\*).*\*\/\s*$/,this.tripleStarBlockCommentRe=/^\s*(\/\*\*\*).*\*\/\s*$/,this.startRegionRe=/^\s*(\/\*|\/\/)#?region\b/,this._getFoldWidgetBase=this.getFoldWidget,this.getFoldWidget=function(e,t,r){var n=e.getLine(r);if(this.singleLineBlockCommentRe.test(n)&&!this.startRegionRe.test(n)&&!this.tripleStarBlockCommentRe.test(n))return"";var o=this._getFoldWidgetBase(e,t,r);return!o&&this.startRegionRe.test(n)?"start":o},this.getFoldWidgetRange=function(e,t,r,n){var o=e.getLine(r);if(this.startRegionRe.test(o))return this.getCommentRegionBlock(e,o,r);var i=o.match(this.foldingStartMarker);if(i){var a=i.index;if(i[1])return this.openingBracketBlock(e,i[1],r,a);var s=e.getCommentFoldRange(r,a+i[0].length,1);return s&&!s.isMultiLine()&&(n?s=this.getSectionRange(e,r):"all"!=t&&(s=null)),s}if("markbegin"!==t){var i=o.match(this.foldingStopMarker);if(i){var a=i.index+i[0].length;return i[1]?this.closingBracketBlock(e,i[1],r,a):e.getCommentFoldRange(r,a,-1)}}},this.getSectionRange=function(e,t){var r=e.getLine(t),n=r.search(/\S/),i=t,a=r.length;t+=1;for(var s=t,l=e.getLength();++t<l;){r=e.getLine(t);var c=r.search(/\S/);if(-1!==c){if(n>c)break;var u=this.getFoldWidgetRange(e,"all",t);if(u){if(u.start.row<=i)break;if(u.isMultiLine())t=u.end.row;else if(n==c)break}s=t}}return new o(i,a,s,e.getLine(s).length)},this.getCommentRegionBlock=function(e,t,r){for(var n=t.search(/\s*$/),i=e.getLength(),a=r,s=/^\s*(?:\/\*|\/\/|--)#?(end)?region\b/,l=1;++r<i;){t=e.getLine(r);var c=s.exec(t);if(c&&(c[1]?l--:l++,!l))break}var u=r;return u>a?new o(a,n,u,t.length):void 0}}.call(a.prototype)}),define("ace/mode/css",["require","exports","module","ace/lib/oop","ace/mode/text","ace/mode/css_highlight_rules","ace/mode/matching_brace_outdent","ace/worker/worker_client","ace/mode/css_completions","ace/mode/behaviour/css","ace/mode/folding/cstyle"],function(e,t,r){"use strict";var n=e("../lib/oop"),o=e("./text").Mode,i=e("./css_highlight_rules").CssHighlightRules,a=e("./matching_brace_outdent").MatchingBraceOutdent,s=e("../worker/worker_client").WorkerClient,l=e("./css_completions").CssCompletions,c=e("./behaviour/css").CssBehaviour,u=e("./folding/cstyle").FoldMode,d=function(){this.HighlightRules=i,this.$outdent=new a,this.$behaviour=new c,this.$completer=new l,this.foldingRules=new u};n.inherits(d,o),function(){this.foldingRules="cStyle",this.blockComment={start:"/*",end:"*/"},this.getNextLineIndent=function(e,t,r){var n=this.$getIndent(t),o=this.getTokenizer().getLineTokens(t,e).tokens;if(o.length&&"comment"==o[o.length-1].type)return n;var i=t.match(/^.*\{\s*$/);return i&&(n+=r),n},this.checkOutdent=function(e,t,r){return this.$outdent.checkOutdent(t,r)},this.autoOutdent=function(e,t,r){this.$outdent.autoOutdent(t,r)},this.getCompletions=function(e,t,r,n){return this.$completer.getCompletions(e,t,r,n)},this.createWorker=function(e){var t=new s(["ace"],"ace/mode/css_worker","Worker");return t.attachToDocument(e.getDocument()),t.on("annotate",function(t){e.setAnnotations(t.data)}),t.on("terminate",function(){e.clearAnnotations()}),t},this.$id="ace/mode/css"}.call(d.prototype),t.Mode=d});