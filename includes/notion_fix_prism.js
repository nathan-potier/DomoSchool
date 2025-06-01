(function () {
  // Appliquer les bonnes classes Prism sur les balises <pre> et <code>
  document.querySelectorAll('pre').forEach(pre => {
    const code = pre.querySelector('code');
    if (code) {
      const match = code.className.match(/language-(\w+)/i);
      if (match) {
        const lang = 'language-' + match[1].toLowerCase();
        code.className = lang;
        pre.className = lang;
        code.removeAttribute('style');
      }
    }
  });

  // Charger Prism.js et le thème si ce n’est pas déjà fait
  function loadScript(src, callback) {
    const s = document.createElement('script');
    s.src = src;
    s.onload = callback;
    document.head.appendChild(s);
  }

  function loadCSS(href) {
    const l = document.createElement('link');
    l.rel = 'stylesheet';
    l.href = href;
    document.head.appendChild(l);
  }

  // Injecter le thème VS Code
  loadCSS("https://cdnjs.cloudflare.com/ajax/libs/prism-themes/1.9.0/prism-vsc-dark-plus.min.css");

  // Appliquer un style de base pour corriger le padding et la lisibilité
  const style = document.createElement('style');
  style.innerHTML = `
    pre[class*="language-"] {
      white-space: pre;
      word-break: normal;
      overflow: auto;
      font-family: Consolas, monospace;
      background: #1e1e1e;
      color: #d4d4d4;
      font-size: 1em;
      line-height: 1.4;
      border-radius: 6px;
      padding: 1em;
      margin: 0.5em 0;
      max-width: 100%;
    }

    code[class*="language-"] {
      font-family: Consolas, monospace;
      color: #d4d4d4;
      background: transparent;
      font-size: 1em;
      line-height: 1.4;
      padding: 0;
    }

    .token.operator {
      background: transparent !important;
      color: #569cd6 !important;
    }

    table {
      display: block;
      overflow-x: auto;
      max-width: 100%;
      border-collapse: collapse;
      margin: 1em 0;
    }
  `;
  document.head.appendChild(style);

  // Charger Prism core et langage Python, puis activer la coloration
  loadScript("https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js", () => {
    loadScript("https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-python.min.js", () => {
      if (window.Prism) Prism.highlightAll();
    });
  });
})();
