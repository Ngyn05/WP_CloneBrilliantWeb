import{r}from"./index-2ffbf897.js";import{c as Pe}from"./client-af107ef4.js";import{b as q,a as Q,V as H,D as Re,O as fe,P as me,c as Te,M as Ee,S as Fe,U as De,d as je,W as Oe,L as se,H as ke,e as Ae,F as ze,f as le,A as Ie,g as Be,N as _e,B as Ne,h as We,i as Le,C as Ue}from"./Gltf-db723e10.js";function $(){return $=Object.assign?Object.assign.bind():function(t){for(var e=1;e<arguments.length;e++){var i=arguments[e];for(var n in i)({}).hasOwnProperty.call(i,n)&&(t[n]=i[n])}return t},$.apply(null,arguments)}const N=new H,ee=new H,Ve=new H,ce=new Te;function $e(t,e,i){const n=N.setFromMatrixPosition(t.matrixWorld);n.project(e);const o=i.width/2,a=i.height/2;return[n.x*o+o,-(n.y*a)+a]}function He(t,e){const i=N.setFromMatrixPosition(t.matrixWorld),n=ee.setFromMatrixPosition(e.matrixWorld),o=i.sub(n),a=e.getWorldDirection(Ve);return o.angleTo(a)>Math.PI/2}function Ge(t,e,i,n){const o=N.setFromMatrixPosition(t.matrixWorld),a=o.clone();a.project(e),ce.set(a.x,a.y),i.setFromCamera(ce,e);const s=i.intersectObjects(n,!0);if(s.length){const u=s[0].distance;return o.distanceTo(i.ray.origin)<u}return!0}function Ke(t,e){if(e instanceof fe)return e.zoom;if(e instanceof me){const i=N.setFromMatrixPosition(t.matrixWorld),n=ee.setFromMatrixPosition(e.matrixWorld),o=e.fov*Math.PI/180,a=i.distanceTo(n);return 1/(2*Math.tan(o/2)*a)}else return 1}function Ze(t,e,i){if(e instanceof me||e instanceof fe){const n=N.setFromMatrixPosition(t.matrixWorld),o=ee.setFromMatrixPosition(e.matrixWorld),a=n.distanceTo(o),s=(i[1]-i[0])/(e.far-e.near),u=i[1]-s*e.far;return Math.round(s*a+u)}}const J=t=>Math.abs(t)<1e-10?0:t;function de(t,e,i=""){let n="matrix3d(";for(let o=0;o!==16;o++)n+=J(e[o]*t.elements[o])+(o!==15?",":")");return i+n}const Xe=(t=>e=>de(e,t))([1,-1,1,1,1,-1,1,1,1,-1,1,1,1,-1,1,1]),Ye=(t=>(e,i)=>de(e,t(i),"translate(-50%,-50%)"))(t=>[1/t,1/t,1/t,1,-1/t,-1/t,-1/t,-1,1/t,1/t,1/t,1,1,1,1,1]);function qe(t){return t&&typeof t=="object"&&"current"in t}const ot=r.forwardRef(({children:t,eps:e=.001,style:i,className:n,prepend:o,center:a,fullscreen:s,portal:u,distanceFactor:c,sprite:P=!1,transform:v=!1,occlude:f,onOcclude:w,castShadow:x,receiveShadow:G,material:K,geometry:b,zIndexRange:D=[16777271,0],calculatePosition:z=$e,as:j="div",wrapperClass:O,pointerEvents:I="auto",...y},h)=>{const{gl:m,camera:d,scene:te,size:g,raycaster:he,events:ve,viewport:pe}=q(),[p]=r.useState(()=>document.createElement(j)),Z=r.useRef(null),S=r.useRef(null),ne=r.useRef(0),W=r.useRef([0,0]),B=r.useRef(null),X=r.useRef(null),k=(u==null?void 0:u.current)||ve.connected||m.domElement.parentNode,R=r.useRef(null),L=r.useRef(!1),U=r.useMemo(()=>f&&f!=="blending"||Array.isArray(f)&&f.length&&qe(f[0]),[f]);r.useLayoutEffect(()=>{const M=m.domElement;f&&f==="blending"?(M.style.zIndex=`${Math.floor(D[0]/2)}`,M.style.position="absolute",M.style.pointerEvents="none"):(M.style.zIndex=null,M.style.position=null,M.style.pointerEvents=null)},[f]),r.useLayoutEffect(()=>{if(S.current){const M=Z.current=Pe.createRoot(p);if(te.updateMatrixWorld(),v)p.style.cssText="position:absolute;top:0;left:0;pointer-events:none;overflow:hidden;";else{const l=z(S.current,d,g);p.style.cssText=`position:absolute;top:0;left:0;transform:translate3d(${l[0]}px,${l[1]}px,0);transform-origin:0 0;`}return k&&(o?k.prepend(p):k.appendChild(p)),()=>{k&&k.removeChild(p),M.unmount()}}},[k,v]),r.useLayoutEffect(()=>{O&&(p.className=O)},[O]);const re=r.useMemo(()=>v?{position:"absolute",top:0,left:0,width:g.width,height:g.height,transformStyle:"preserve-3d",pointerEvents:"none"}:{position:"absolute",transform:a?"translate3d(-50%,-50%,0)":"none",...s&&{top:-g.height/2,left:-g.width/2,width:g.width,height:g.height},...i},[i,a,s,g,v]),xe=r.useMemo(()=>({position:"absolute",pointerEvents:I}),[I]);r.useLayoutEffect(()=>{if(L.current=!1,v){var M;(M=Z.current)==null||M.render(r.createElement("div",{ref:B,style:re},r.createElement("div",{ref:X,style:xe},r.createElement("div",{ref:h,className:n,style:i,children:t}))))}else{var l;(l=Z.current)==null||l.render(r.createElement("div",{ref:h,style:re,className:n,children:t}))}});const A=r.useRef(!0);Q(M=>{if(S.current){d.updateMatrixWorld(),S.current.updateWorldMatrix(!0,!1);const l=v?W.current:z(S.current,d,g);if(v||Math.abs(ne.current-d.zoom)>e||Math.abs(W.current[0]-l[0])>e||Math.abs(W.current[1]-l[1])>e){const T=He(S.current,d);let C=!1;U&&(Array.isArray(f)?C=f.map(E=>E.current):f!=="blending"&&(C=[te]));const _=A.current;if(C){const E=Ge(S.current,d,he,C);A.current=E&&!T}else A.current=!T;_!==A.current&&(w?w(!A.current):p.style.display=A.current?"block":"none");const V=Math.floor(D[0]/2),ge=f?U?[D[0],V]:[V-1,0]:D;if(p.style.zIndex=`${Ze(S.current,d,ge)}`,v){const[E,ie]=[g.width/2,g.height/2],Y=d.projectionMatrix.elements[5]*ie,{isOrthographicCamera:ae,top:Me,left:ye,bottom:Se,right:be}=d,we=Xe(d.matrixWorldInverse),Ce=ae?`scale(${Y})translate(${J(-(be+ye)/2)}px,${J((Me+Se)/2)}px)`:`translateZ(${Y}px)`;let F=S.current.matrixWorld;P&&(F=d.matrixWorldInverse.clone().transpose().copyPosition(F).scale(S.current.scale),F.elements[3]=F.elements[7]=F.elements[11]=0,F.elements[15]=1),p.style.width=g.width+"px",p.style.height=g.height+"px",p.style.perspective=ae?"":`${Y}px`,B.current&&X.current&&(B.current.style.transform=`${Ce}${we}translate(${E}px,${ie}px)`,X.current.style.transform=Ye(F,1/((c||10)/400)))}else{const E=c===void 0?1:Ke(S.current,d)*c;p.style.transform=`translate3d(${l[0]}px,${l[1]}px,0) scale(${E})`}W.current=l,ne.current=d.zoom}}if(!U&&R.current&&!L.current)if(v){if(B.current){const l=B.current.children[0];if(l!=null&&l.clientWidth&&l!=null&&l.clientHeight){const{isOrthographicCamera:T}=d;if(T||b)y.scale&&(Array.isArray(y.scale)?y.scale instanceof H?R.current.scale.copy(y.scale.clone().divideScalar(1)):R.current.scale.set(1/y.scale[0],1/y.scale[1],1/y.scale[2]):R.current.scale.setScalar(1/y.scale));else{const C=(c||10)/400,_=l.clientWidth*C,V=l.clientHeight*C;R.current.scale.set(_,V,1)}L.current=!0}}}else{const l=p.children[0];if(l!=null&&l.clientWidth&&l!=null&&l.clientHeight){const T=1/pe.factor,C=l.clientWidth*T,_=l.clientHeight*T;R.current.scale.set(C,_,1),L.current=!0}R.current.lookAt(M.camera.position)}});const oe=r.useMemo(()=>({vertexShader:v?void 0:`
          /*
            This shader is from the THREE's SpriteMaterial.
            We need to turn the backing plane into a Sprite
            (make it always face the camera) if "transfrom"
            is false.
          */
          #include <common>

          void main() {
            vec2 center = vec2(0., 1.);
            float rotation = 0.0;

            // This is somewhat arbitrary, but it seems to work well
            // Need to figure out how to derive this dynamically if it even matters
            float size = 0.03;

            vec4 mvPosition = modelViewMatrix * vec4( 0.0, 0.0, 0.0, 1.0 );
            vec2 scale;
            scale.x = length( vec3( modelMatrix[ 0 ].x, modelMatrix[ 0 ].y, modelMatrix[ 0 ].z ) );
            scale.y = length( vec3( modelMatrix[ 1 ].x, modelMatrix[ 1 ].y, modelMatrix[ 1 ].z ) );

            bool isPerspective = isPerspectiveMatrix( projectionMatrix );
            if ( isPerspective ) scale *= - mvPosition.z;

            vec2 alignedPosition = ( position.xy - ( center - vec2( 0.5 ) ) ) * scale * size;
            vec2 rotatedPosition;
            rotatedPosition.x = cos( rotation ) * alignedPosition.x - sin( rotation ) * alignedPosition.y;
            rotatedPosition.y = sin( rotation ) * alignedPosition.x + cos( rotation ) * alignedPosition.y;
            mvPosition.xy += rotatedPosition;

            gl_Position = projectionMatrix * mvPosition;
          }
      `,fragmentShader:`
        void main() {
          gl_FragColor = vec4(0.0, 0.0, 0.0, 0.0);
        }
      `}),[v]);return r.createElement("group",$({},y,{ref:S}),f&&!U&&r.createElement("mesh",{castShadow:x,receiveShadow:G,ref:R},b||r.createElement("planeGeometry",null),K||r.createElement("shaderMaterial",{side:Re,vertexShader:oe.vertexShader,fragmentShader:oe.fragmentShader})))});function Je(t,e,i,n){var o;return o=class extends Fe{constructor(a){super({vertexShader:e,fragmentShader:i,...a});for(const s in t)this.uniforms[s]=new De(t[s]),Object.defineProperty(this,s,{get(){return this.uniforms[s].value},set(u){this.uniforms[s].value=u}});this.uniforms=je.clone(this.uniforms),n==null||n(this)}},o.key=Ee.generateUUID(),o}function ue(t,e,i){const n=q(x=>x.size),o=q(x=>x.viewport),a=typeof t=="number"?t:n.width*o.dpr,s=typeof e=="number"?e:n.height*o.dpr,u=(typeof t=="number"?i:t)||{},{samples:c=0,depth:P,...v}=u,f=P??u.depthBuffer,w=r.useMemo(()=>{const x=new Oe(a,s,{minFilter:se,magFilter:se,type:ke,...v});return f&&(x.depthTexture=new Ae(a,s,ze)),x.samples=c,x},[]);return r.useLayoutEffect(()=>{w.setSize(a,s),c&&(w.samples=c)},[c,w,a,s]),r.useEffect(()=>()=>w.dispose(),[]),w}function it(t,e){const i=r.useRef(null),[n]=r.useState(()=>e?e instanceof le?{current:e}:e:i),[o]=r.useState(()=>new Ie(void 0));r.useLayoutEffect(()=>{e&&(n.current=e instanceof le?e:e.current),o._root=n.current});const a=r.useRef({}),s=r.useMemo(()=>{const u={};return t.forEach(c=>Object.defineProperty(u,c.name,{enumerable:!0,get(){if(n.current)return a.current[c.name]||(a.current[c.name]=o.clipAction(c,n.current))},configurable:!0})),{ref:n,clips:t,actions:u,names:t.map(c=>c.name),mixer:o}},[t]);return Q((u,c)=>o.update(c)),r.useEffect(()=>{const u=n.current;return()=>{a.current={},o.stopAllAction(),Object.values(s.actions).forEach(c=>{u&&o.uncacheAction(c,u)})}},[t]),s}const Qe=Je({},"void main() { }","void main() { gl_FragColor = vec4(0.0, 0.0, 0.0, 0.0); discard;  }");class et extends Le{constructor(e=6,i=!1){super(),this.uniforms={chromaticAberration:{value:.05},transmission:{value:0},_transmission:{value:1},transmissionMap:{value:null},roughness:{value:0},thickness:{value:0},thicknessMap:{value:null},attenuationDistance:{value:1/0},attenuationColor:{value:new Ue("white")},anisotropicBlur:{value:.1},time:{value:0},distortion:{value:0},distortionScale:{value:.5},temporalDistortion:{value:0},buffer:{value:null}},this.onBeforeCompile=n=>{n.uniforms={...n.uniforms,...this.uniforms},this.anisotropy>0&&(n.defines.USE_ANISOTROPY=""),i?n.defines.USE_SAMPLER="":n.defines.USE_TRANSMISSION="",n.fragmentShader=`
      uniform float chromaticAberration;         
      uniform float anisotropicBlur;      
      uniform float time;
      uniform float distortion;
      uniform float distortionScale;
      uniform float temporalDistortion;
      uniform sampler2D buffer;

      vec3 random3(vec3 c) {
        float j = 4096.0*sin(dot(c,vec3(17.0, 59.4, 15.0)));
        vec3 r;
        r.z = fract(512.0*j);
        j *= .125;
        r.x = fract(512.0*j);
        j *= .125;
        r.y = fract(512.0*j);
        return r-0.5;
      }

      uint hash( uint x ) {
        x += ( x << 10u );
        x ^= ( x >>  6u );
        x += ( x <<  3u );
        x ^= ( x >> 11u );
        x += ( x << 15u );
        return x;
      }

      // Compound versions of the hashing algorithm I whipped together.
      uint hash( uvec2 v ) { return hash( v.x ^ hash(v.y)                         ); }
      uint hash( uvec3 v ) { return hash( v.x ^ hash(v.y) ^ hash(v.z)             ); }
      uint hash( uvec4 v ) { return hash( v.x ^ hash(v.y) ^ hash(v.z) ^ hash(v.w) ); }

      // Construct a float with half-open range [0:1] using low 23 bits.
      // All zeroes yields 0.0, all ones yields the next smallest representable value below 1.0.
      float floatConstruct( uint m ) {
        const uint ieeeMantissa = 0x007FFFFFu; // binary32 mantissa bitmask
        const uint ieeeOne      = 0x3F800000u; // 1.0 in IEEE binary32
        m &= ieeeMantissa;                     // Keep only mantissa bits (fractional part)
        m |= ieeeOne;                          // Add fractional part to 1.0
        float  f = uintBitsToFloat( m );       // Range [1:2]
        return f - 1.0;                        // Range [0:1]
      }

      // Pseudo-random value in half-open range [0:1].
      float randomBase( float x ) { return floatConstruct(hash(floatBitsToUint(x))); }
      float randomBase( vec2  v ) { return floatConstruct(hash(floatBitsToUint(v))); }
      float randomBase( vec3  v ) { return floatConstruct(hash(floatBitsToUint(v))); }
      float randomBase( vec4  v ) { return floatConstruct(hash(floatBitsToUint(v))); }
      float rand(float seed) {
        float result = randomBase(vec3(gl_FragCoord.xy, seed));
        return result;
      }

      const float F3 =  0.3333333;
      const float G3 =  0.1666667;

      float snoise(vec3 p) {
        vec3 s = floor(p + dot(p, vec3(F3)));
        vec3 x = p - s + dot(s, vec3(G3));
        vec3 e = step(vec3(0.0), x - x.yzx);
        vec3 i1 = e*(1.0 - e.zxy);
        vec3 i2 = 1.0 - e.zxy*(1.0 - e);
        vec3 x1 = x - i1 + G3;
        vec3 x2 = x - i2 + 2.0*G3;
        vec3 x3 = x - 1.0 + 3.0*G3;
        vec4 w, d;
        w.x = dot(x, x);
        w.y = dot(x1, x1);
        w.z = dot(x2, x2);
        w.w = dot(x3, x3);
        w = max(0.6 - w, 0.0);
        d.x = dot(random3(s), x);
        d.y = dot(random3(s + i1), x1);
        d.z = dot(random3(s + i2), x2);
        d.w = dot(random3(s + 1.0), x3);
        w *= w;
        w *= w;
        d *= w;
        return dot(d, vec4(52.0));
      }

      float snoiseFractal(vec3 m) {
        return 0.5333333* snoise(m)
              +0.2666667* snoise(2.0*m)
              +0.1333333* snoise(4.0*m)
              +0.0666667* snoise(8.0*m);
      }
`+n.fragmentShader,n.fragmentShader=n.fragmentShader.replace("#include <transmission_pars_fragment>",`
        #ifdef USE_TRANSMISSION
          // Transmission code is based on glTF-Sampler-Viewer
          // https://github.com/KhronosGroup/glTF-Sample-Viewer
          uniform float _transmission;
          uniform float thickness;
          uniform float attenuationDistance;
          uniform vec3 attenuationColor;
          #ifdef USE_TRANSMISSIONMAP
            uniform sampler2D transmissionMap;
          #endif
          #ifdef USE_THICKNESSMAP
            uniform sampler2D thicknessMap;
          #endif
          uniform vec2 transmissionSamplerSize;
          uniform sampler2D transmissionSamplerMap;
          uniform mat4 modelMatrix;
          uniform mat4 projectionMatrix;
          varying vec3 vWorldPosition;
          vec3 getVolumeTransmissionRay( const in vec3 n, const in vec3 v, const in float thickness, const in float ior, const in mat4 modelMatrix ) {
            // Direction of refracted light.
            vec3 refractionVector = refract( - v, normalize( n ), 1.0 / ior );
            // Compute rotation-independant scaling of the model matrix.
            vec3 modelScale;
            modelScale.x = length( vec3( modelMatrix[ 0 ].xyz ) );
            modelScale.y = length( vec3( modelMatrix[ 1 ].xyz ) );
            modelScale.z = length( vec3( modelMatrix[ 2 ].xyz ) );
            // The thickness is specified in local space.
            return normalize( refractionVector ) * thickness * modelScale;
          }
          float applyIorToRoughness( const in float roughness, const in float ior ) {
            // Scale roughness with IOR so that an IOR of 1.0 results in no microfacet refraction and
            // an IOR of 1.5 results in the default amount of microfacet refraction.
            return roughness * clamp( ior * 2.0 - 2.0, 0.0, 1.0 );
          }
          vec4 getTransmissionSample( const in vec2 fragCoord, const in float roughness, const in float ior ) {
            float framebufferLod = log2( transmissionSamplerSize.x ) * applyIorToRoughness( roughness, ior );            
            #ifdef USE_SAMPLER
              #ifdef texture2DLodEXT
                return texture2DLodEXT(transmissionSamplerMap, fragCoord.xy, framebufferLod);
              #else
                return texture2D(transmissionSamplerMap, fragCoord.xy, framebufferLod);
              #endif
            #else
              return texture2D(buffer, fragCoord.xy);
            #endif
          }
          vec3 applyVolumeAttenuation( const in vec3 radiance, const in float transmissionDistance, const in vec3 attenuationColor, const in float attenuationDistance ) {
            if ( isinf( attenuationDistance ) ) {
              // Attenuation distance is +∞, i.e. the transmitted color is not attenuated at all.
              return radiance;
            } else {
              // Compute light attenuation using Beer's law.
              vec3 attenuationCoefficient = -log( attenuationColor ) / attenuationDistance;
              vec3 transmittance = exp( - attenuationCoefficient * transmissionDistance ); // Beer's law
              return transmittance * radiance;
            }
          }
          vec4 getIBLVolumeRefraction( const in vec3 n, const in vec3 v, const in float roughness, const in vec3 diffuseColor,
            const in vec3 specularColor, const in float specularF90, const in vec3 position, const in mat4 modelMatrix,
            const in mat4 viewMatrix, const in mat4 projMatrix, const in float ior, const in float thickness,
            const in vec3 attenuationColor, const in float attenuationDistance ) {
            vec3 transmissionRay = getVolumeTransmissionRay( n, v, thickness, ior, modelMatrix );
            vec3 refractedRayExit = position + transmissionRay;
            // Project refracted vector on the framebuffer, while mapping to normalized device coordinates.
            vec4 ndcPos = projMatrix * viewMatrix * vec4( refractedRayExit, 1.0 );
            vec2 refractionCoords = ndcPos.xy / ndcPos.w;
            refractionCoords += 1.0;
            refractionCoords /= 2.0;
            // Sample framebuffer to get pixel the refracted ray hits.
            vec4 transmittedLight = getTransmissionSample( refractionCoords, roughness, ior );
            vec3 attenuatedColor = applyVolumeAttenuation( transmittedLight.rgb, length( transmissionRay ), attenuationColor, attenuationDistance );
            // Get the specular component.
            vec3 F = EnvironmentBRDF( n, v, specularColor, specularF90, roughness );
            return vec4( ( 1.0 - F ) * attenuatedColor * diffuseColor, transmittedLight.a );
          }
        #endif
`),n.fragmentShader=n.fragmentShader.replace("#include <transmission_fragment>",`  
        // Improve the refraction to use the world pos
        material.transmission = _transmission;
        material.transmissionAlpha = 1.0;
        material.thickness = thickness;
        material.attenuationDistance = attenuationDistance;
        material.attenuationColor = attenuationColor;
        #ifdef USE_TRANSMISSIONMAP
          material.transmission *= texture2D( transmissionMap, vUv ).r;
        #endif
        #ifdef USE_THICKNESSMAP
          material.thickness *= texture2D( thicknessMap, vUv ).g;
        #endif
        
        vec3 pos = vWorldPosition;
        float runningSeed = 0.0;
        vec3 v = normalize( cameraPosition - pos );
        vec3 n = inverseTransformDirection( normal, viewMatrix );
        vec3 transmission = vec3(0.0);
        float transmissionR, transmissionB, transmissionG;
        float randomCoords = rand(runningSeed++);
        float thickness_smear = thickness * max(pow(roughnessFactor, 0.33), anisotropicBlur);
        vec3 distortionNormal = vec3(0.0);
        vec3 temporalOffset = vec3(time, -time, -time) * temporalDistortion;
        if (distortion > 0.0) {
          distortionNormal = distortion * vec3(snoiseFractal(vec3((pos * distortionScale + temporalOffset))), snoiseFractal(vec3(pos.zxy * distortionScale - temporalOffset)), snoiseFractal(vec3(pos.yxz * distortionScale + temporalOffset)));
        }
        for (float i = 0.0; i < ${e}.0; i ++) {
          vec3 sampleNorm = normalize(n + roughnessFactor * roughnessFactor * 2.0 * normalize(vec3(rand(runningSeed++) - 0.5, rand(runningSeed++) - 0.5, rand(runningSeed++) - 0.5)) * pow(rand(runningSeed++), 0.33) + distortionNormal);
          transmissionR = getIBLVolumeRefraction(
            sampleNorm, v, material.roughness, material.diffuseColor, material.specularColor, material.specularF90,
            pos, modelMatrix, viewMatrix, projectionMatrix, material.ior, material.thickness  + thickness_smear * (i + randomCoords) / float(${e}),
            material.attenuationColor, material.attenuationDistance
          ).r;
          transmissionG = getIBLVolumeRefraction(
            sampleNorm, v, material.roughness, material.diffuseColor, material.specularColor, material.specularF90,
            pos, modelMatrix, viewMatrix, projectionMatrix, material.ior  * (1.0 + chromaticAberration * (i + randomCoords) / float(${e})) , material.thickness + thickness_smear * (i + randomCoords) / float(${e}),
            material.attenuationColor, material.attenuationDistance
          ).g;
          transmissionB = getIBLVolumeRefraction(
            sampleNorm, v, material.roughness, material.diffuseColor, material.specularColor, material.specularF90,
            pos, modelMatrix, viewMatrix, projectionMatrix, material.ior * (1.0 + 2.0 * chromaticAberration * (i + randomCoords) / float(${e})), material.thickness + thickness_smear * (i + randomCoords) / float(${e}),
            material.attenuationColor, material.attenuationDistance
          ).b;
          transmission.r += transmissionR;
          transmission.g += transmissionG;
          transmission.b += transmissionB;
        }
        transmission /= ${e}.0;
        totalDiffuse = mix( totalDiffuse, transmission.rgb, material.transmission );
`)},Object.keys(this.uniforms).forEach(n=>Object.defineProperty(this,n,{get:()=>this.uniforms[n].value,set:o=>this.uniforms[n].value=o}))}}const at=r.forwardRef(({buffer:t,transmissionSampler:e=!1,backside:i=!1,side:n=We,transmission:o=1,thickness:a=0,backsideThickness:s=0,backsideEnvMapIntensity:u=1,samples:c=10,resolution:P,backsideResolution:v,background:f,anisotropy:w,anisotropicBlur:x,...G},K)=>{Be({MeshTransmissionMaterial:et});const b=r.useRef(null),[D]=r.useState(()=>new Qe),z=ue(v||P),j=ue(P);let O,I,y,h;return Q(m=>{if(b.current.time=m.clock.elapsedTime,b.current.buffer===j.texture&&!e){var d;h=(d=b.current.__r3f.parent)==null?void 0:d.object,h&&(y=m.gl.toneMapping,O=m.scene.background,I=b.current.envMapIntensity,m.gl.toneMapping=_e,f&&(m.scene.background=f),h.material=D,i&&(m.gl.setRenderTarget(z),m.gl.render(m.scene,m.camera),h.material=b.current,h.material.buffer=z.texture,h.material.thickness=s,h.material.side=Ne,h.material.envMapIntensity=u),m.gl.setRenderTarget(j),m.gl.render(m.scene,m.camera),h.material=b.current,h.material.thickness=a,h.material.side=n,h.material.buffer=j.texture,h.material.envMapIntensity=I,m.scene.background=O,m.gl.setRenderTarget(null),m.gl.toneMapping=y)}}),r.useImperativeHandle(K,()=>b.current,[]),r.createElement("meshTransmissionMaterial",$({args:[c,e],ref:b},G,{buffer:t||j.texture,_transmission:o,anisotropicBlur:x??w,transmission:e?o:0,thickness:a,side:n}))});export{ot as H,at as M,$ as _,ue as a,it as u};
