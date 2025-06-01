(function () {
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

  function loadScript(src, callback) {
    const s = document.createElement('script');
    s.src = src;
    s.onload = callback;
    document.head.appendChild(s);
  }

  function injectStyles(isDark) {
    const style = document.createElement('style');
    style.textContent = `
      pre[class*="language-"] {
        white-space: pre !important;
        word-break: normal !important;
        overflow: auto !important;
        font-family: 'SF Mono', 'Fira Code', 'Roboto Mono', monospace !important;
        font-size: 1em !important;
        line-height: 1.5 !important;
        border-radius: 6px !important;
        padding: 1em !important;
        margin: 0.5em 0 !important;
        max-width: 100% !important;
        border: 1px solid !important;
        transition: background-color 0.3s, color 0.3s !important;
        background: ${isDark ? '#1e1e1e' : '#fefefe'} !important;
        color: ${isDark ? '#d4d4d4' : '#2e2e2e'} !important;
        border-color: ${isDark ? '#333333' : '#ddd'} !important;
      }

      code[class*="language-"] {
        font-family: 'SF Mono', 'Fira Code', 'Roboto Mono', monospace !important;
        font-size: 0.9em !important;
        line-height: 1.5 !important;
        padding: 0 !important;
        background: transparent !important;
      }

      table {
        display: block !important;
        overflow-x: auto !important;
        max-width: 100% !important;
        border-collapse: collapse !important;
        margin: 1em 0 !important;
      }

      .token.comment {
        color: ${isDark ? '#6a9955' : '#7c7c7c'} !important;
        font-style: italic !important;
      }

      .token.keyword {
        color: ${isDark ? '#569cd6' : '#0000ff'} !important;
        font-weight: bold !important;
      }

      .token.operator {
        color: ${isDark ? '#d4d4d4' : '#000000'} !important;
        background: transparent !important;
      }

      .token.string {
        color: ${isDark ? '#d69d85' : '#a31515'} !important;
      }

      .token.function {
        color: ${isDark ? '#dcdcaa' : '#795e26'} !important;
        font-weight: bold !important;
      }

      .token.number {
        color: ${isDark ? '#b5cea8' : '#000080'} !important;
      }

      .token.builtin {
        color: ${isDark ? '#4ec9b0' : '#008080'} !important;
        font-weight: bold !important;
      }
    `;
    document.head.appendChild(style);
  }

  const currentMode = localStorage.getItem('mode');
  const isDark = currentMode === 'mode-dark';

  loadScript("https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js", () => {
    loadScript("https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-python.min.js", () => {
      injectStyles(isDark);
      if (window.Prism) Prism.highlightAll();
    });
  });
})();
