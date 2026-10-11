<style>
    :root { color-scheme: dark; font-family: Georgia, 'Times New Roman', serif; --ink: #e8eef5; --muted: #9aaabd; --panel: #111d2d; --panel-light: #17263a; --line: rgba(190, 210, 230, .16); --cyan: #69e4e0; --cyan-dark: #082b35; }
    * { box-sizing: border-box; }
    body { margin: 0; min-width: 320px; background: #08111f; color: var(--ink); }
    a { color: inherit; text-decoration: none; }
    button, input, select { font: inherit; }
    .app-shell > header { background: rgba(13, 27, 44, .94); border-bottom: 1px solid var(--line); }
    .app-shell > header > div { width: min(1152px, calc(100% - 48px)); min-height: 72px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 24px; }
    .app-shell > header a { color: white; font-size: 20px; font-weight: 700; letter-spacing: -.02em; }
    .app-shell > header > div > div { display: flex; align-items: center; justify-content: flex-end; gap: 18px; color: var(--muted); font-family: Arial, sans-serif; font-size: 13px; }
    .app-shell > header form { margin: 0; }
    .app-shell > header button { border: 1px solid var(--line); border-radius: 6px; background: transparent; color: var(--ink); padding: 9px 13px; cursor: pointer; }
    .app-shell > header button:hover { border-color: var(--cyan); color: var(--cyan); }
    .app-shell > header a[href*="users"] { color: var(--cyan); font-weight: 600; }
    .app-shell > main { width: min(1152px, calc(100% - 48px)); margin: 0 auto; padding: 56px 0 72px; }
    .app-shell main > div:first-child { display: flex; align-items: flex-end; justify-content: space-between; gap: 24px; }
    h1 { margin: 10px 0 0; color: #fff; font-size: clamp(32px, 5vw, 54px); line-height: 1.05; letter-spacing: -.04em; }
    p { margin: 0; line-height: 1.6; }
    .app-shell p { color: var(--muted); font-family: Arial, sans-serif; }
    .app-shell main > div:first-child p:first-child { color: var(--cyan); font-size: 12px; font-weight: 700; letter-spacing: .2em; text-transform: uppercase; }
    .app-shell main > div:first-child p:last-child { max-width: 570px; margin-top: 12px; }
    .app-shell a[class*="bg-cyan"], .app-shell button[class*="bg-cyan"] { display: inline-block; border: 0; border-radius: 6px; background: var(--cyan); color: #07151e; padding: 12px 17px; font-family: Arial, sans-serif; font-size: 14px; font-weight: 700; cursor: pointer; }
    .app-shell a[class*="bg-cyan"]:hover, .app-shell button[class*="bg-cyan"]:hover { background: #a4f4ed; }
    .app-shell section { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-top: 42px; }
    .app-shell section > div, .app-shell main > div[class*="rounded-xl"] { border: 1px solid var(--line); border-radius: 12px; background: var(--panel); padding: 22px; }
    .app-shell section p:first-child { color: var(--muted); font-size: 13px; }
    .app-shell section p:last-child { margin-top: 10px; color: white; font-family: Arial, sans-serif; font-size: 20px; font-weight: 700; }
    .app-shell section p.text-emerald-300 { color: #7df0b6; }
    .app-shell table { width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px; }
    .app-shell table th { color: var(--muted); font-size: 12px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; }
    .app-shell table th, .app-shell table td { padding: 17px 20px; text-align: left; }
    .app-shell table tr { border-bottom: 1px solid var(--line); }
    .app-shell table tbody tr:last-child { border-bottom: 0; }
    .app-shell table td { color: #d7e1ec; }
    .app-shell table td:first-child { color: white; font-weight: 700; }
    .app-shell table td:last-child { text-align: right; }
    .app-shell table a { color: var(--cyan); font-weight: 600; }
    .app-shell table button { border: 0; background: none; color: #ff9fae; cursor: pointer; }
    .app-shell table span { display: inline-block; border-radius: 999px; background: rgba(105, 228, 224, .12); color: var(--cyan); padding: 6px 10px; font-size: 12px; }
    .app-shell form { font-family: Arial, sans-serif; }
    .app-shell form label { display: block; margin-bottom: 18px; color: #cbd6e2; font-size: 13px; }
    .app-shell form input, .app-shell form select { display: block; width: 100%; margin-top: 8px; border: 1px solid var(--line); border-radius: 6px; background: #091522; color: white; padding: 12px 13px; outline: none; }
    .app-shell form input:focus, .app-shell form select:focus { border-color: var(--cyan); box-shadow: 0 0 0 3px rgba(105, 228, 224, .12); }
    .app-shell form .text-slate-500 { color: var(--muted); }
    .app-shell .border-rose-400\/30, .app-shell .bg-rose-400\/10 { border: 1px solid rgba(255, 120, 140, .35); background: rgba(255, 120, 140, .1); color: #ffb8c3; padding: 13px 15px; border-radius: 6px; }
    .auth-page { display: grid; min-height: 100vh; place-items: center; padding: 32px 20px; background: radial-gradient(circle at 10% 10%, #193d4c 0, transparent 32%), linear-gradient(135deg, #071321, #10283a 55%, #08121f); }
    .auth-page main { width: min(100%, 470px); border: 1px solid rgba(190, 220, 230, .18); border-radius: 18px; background: rgba(12, 28, 45, .88); padding: 42px; box-shadow: 0 24px 70px rgba(0, 0, 0, .4); }
    .auth-page p:first-child { color: var(--cyan); font-family: Arial, sans-serif; font-size: 12px; font-weight: 700; letter-spacing: .25em; text-transform: uppercase; }
    .auth-page h1 { margin-top: 14px; font-size: clamp(34px, 7vw, 48px); }
    .auth-page p:nth-of-type(2) { margin-top: 12px; color: var(--muted); font-family: Arial, sans-serif; line-height: 1.5; }
    .auth-page form { margin-top: 32px; font-family: Arial, sans-serif; }
    .auth-page label { display: block; margin-top: 18px; color: #cbd6e2; font-size: 13px; }
    .auth-page label input[type="email"], .auth-page label input[type="password"] { display: block; width: 100%; margin-top: 8px; border: 1px solid var(--line); border-radius: 6px; background: #081522; color: white; padding: 13px; outline: none; }
    .auth-page label input:focus { border-color: var(--cyan); box-shadow: 0 0 0 3px rgba(105, 228, 224, .12); }
    .auth-page label:has(input[type="checkbox"]) { display: flex; align-items: center; gap: 8px; color: var(--muted); }
    .auth-page input[type="checkbox"] { accent-color: var(--cyan); }
    .auth-page button { width: 100%; margin-top: 24px; border: 0; border-radius: 6px; background: var(--cyan); color: #07151e; padding: 14px; font-weight: 700; cursor: pointer; }
    .auth-page button:hover { background: #a4f4ed; }
    .auth-register-link { margin-top: 24px; color: var(--muted); font-family: Arial, sans-serif; font-size: 13px; text-align: center; }
    .auth-register-link a { color: var(--cyan); font-weight: 700; }
    .auth-page .border-rose-400\/30 { margin-top: 22px; border: 1px solid rgba(255, 120, 140, .35); background: rgba(255, 120, 140, .1); color: #ffb8c3; padding: 13px 15px; border-radius: 6px; font-family: Arial, sans-serif; font-size: 13px; }
    @media (max-width: 700px) { .app-shell > header > div, .app-shell > main { width: min(100% - 32px, 1152px); } .app-shell > header > div { align-items: flex-start; flex-direction: column; padding: 16px 0; } .app-shell > header > div > div { width: 100%; justify-content: flex-start; flex-wrap: wrap; } .app-shell main > div:first-child { align-items: flex-start; flex-direction: column; } .app-shell section { grid-template-columns: 1fr; } .app-shell table { min-width: 650px; } .app-shell main > div[class*="overflow"] { overflow-x: auto; } .auth-page main { padding: 30px 24px; } }
</style>
