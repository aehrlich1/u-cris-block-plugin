(()=>{"use strict";var r,e={861:()=>{const r=window.wp.blocks,e=window.wp.i18n,o=window.wp.blockEditor,t=window.wp.components,i=window.ReactJSXRuntime,n=JSON.parse('{"UU":"create-block/ucris-publications-block"}');(0,r.registerBlockType)(n.UU,{edit:function({attributes:r,setAttributes:n}){const{startingYear:s}=r;return(0,i.jsxs)(i.Fragment,{children:[(0,i.jsx)(o.InspectorControls,{children:(0,i.jsx)(t.PanelBody,{title:(0,e.__)("Settings","ucris-publications-block"),children:(0,i.jsx)(t.TextControl,{label:(0,e.__)("Starting Year","ucris-publications-block"),value:s||"",onChange:r=>n({startingYear:r})})})}),(0,i.jsx)("p",{...(0,o.useBlockProps)(),children:(0,e.__)("u:cris Publications Block – Placeholder","ucris-publications-block")})]})}})}},o={};function t(r){var i=o[r];if(void 0!==i)return i.exports;var n=o[r]={exports:{}};return e[r](n,n.exports,t),n.exports}t.m=e,r=[],t.O=(e,o,i,n)=>{if(!o){var s=1/0;for(u=0;u<r.length;u++){o=r[u][0],i=r[u][1],n=r[u][2];for(var c=!0,l=0;l<o.length;l++)(!1&n||s>=n)&&Object.keys(t.O).every((r=>t.O[r](o[l])))?o.splice(l--,1):(c=!1,n<s&&(s=n));if(c){r.splice(u--,1);var a=i();void 0!==a&&(e=a)}}return e}n=n||0;for(var u=r.length;u>0&&r[u-1][2]>n;u--)r[u]=r[u-1];r[u]=[o,i,n]},t.o=(r,e)=>Object.prototype.hasOwnProperty.call(r,e),(()=>{var r={57:0,350:0};t.O.j=e=>0===r[e];var e=(e,o)=>{var i,n,s=o[0],c=o[1],l=o[2],a=0;if(s.some((e=>0!==r[e]))){for(i in c)t.o(c,i)&&(t.m[i]=c[i]);if(l)var u=l(t)}for(e&&e(o);a<s.length;a++)n=s[a],t.o(r,n)&&r[n]&&r[n][0](),r[n]=0;return t.O(u)},o=self.webpackChunkucris_publications_block=self.webpackChunkucris_publications_block||[];o.forEach(e.bind(null,0)),o.push=e.bind(null,o.push.bind(o))})();var i=t.O(void 0,[350],(()=>t(861)));i=t.O(i)})();