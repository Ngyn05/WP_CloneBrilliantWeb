class Footer extends HTMLElement{constructor(){super(),this.countrySelect=this.querySelector("[data-footer-country-select]"),this.countrySelectWrapper=this.querySelector("[data-footer-country-select-wrapper]"),this.languageSelect=this.querySelector("[data-footer-language-select]"),this.countrySelect&&(this.countrySelect.addEventListener("change",this.updateFooterSeletSize.bind(this)),this.updateFooterSeletSize())}updateFooterSeletSize(){const selectedText=this.countrySelect.options[this.countrySelect.selectedIndex].text,placeholderSelect=document.createElement("select");placeholderSelect.classList.add("footer__select","hide"),placeholderSelect.innerHTML=`
      <option>
        ${selectedText}
      </option>
    `,this.countrySelectWrapper.appendChild(placeholderSelect),this.countrySelect.style.width=`${placeholderSelect.offsetWidth}px`,this.languageSelect&&(this.languageSelect.style.width=`${placeholderSelect.offsetWidth}px`),placeholderSelect.remove()}}customElements.define("site-footer",Footer);
//# sourceMappingURL=/cdn/shop/t/24/assets/section-footer.js.map?v=25646550262897395881752050581
