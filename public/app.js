/* Portfolio interactions: tema, navbar, transisi halaman, filter, preview proyek, lightbox */
(function () {
  'use strict';

  const $ = (sel, root = document) => root.querySelector(sel);
  const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- AOS (animasi scroll) ---------- */
  if (window.AOS) {
    AOS.init({ duration: 1000, once: true });
  } else {
    document.documentElement.classList.add('no-aos');
    $$('[data-aos]').forEach((el) => el.classList.add('aos-animate'));
  }

  /* ---------- Mode gelap / terang ---------- */
  const root = document.documentElement;
  const themeBtn = $('#themeToggle');

  function applyTheme(theme) {
    root.dataset.theme = theme;
    if (!themeBtn) return;
    themeBtn.textContent = theme === 'light' ? '☾' : '☀';
    themeBtn.setAttribute('aria-label', theme === 'light' ? 'Aktifkan mode gelap' : 'Aktifkan mode terang');
  }
  applyTheme(root.dataset.theme || 'dark');
  if (themeBtn) {
    themeBtn.addEventListener('click', () => {
      const next = root.dataset.theme === 'light' ? 'dark' : 'light';
      applyTheme(next);
      try { localStorage.setItem('theme', next); } catch (e) { /* storage dinonaktifkan */ }
    });
  }

  /* ---------- Navbar: scroll kiri/kanan ---------- */
  const nav = $('#navScroll');
  if (nav) {
    const arrows = $$('.navArrow');
    const updateArrows = () => {
      if (arrows.length < 2) return;
      arrows[0].disabled = nav.scrollLeft <= 2;
      arrows[1].disabled = nav.scrollLeft >= nav.scrollWidth - nav.clientWidth - 2;
    };
    arrows.forEach((btn) => btn.addEventListener('click', () => {
      nav.scrollBy({ left: Number(btn.dataset.dir) * nav.clientWidth * 0.7, behavior: 'smooth' });
    }));
    nav.addEventListener('scroll', updateArrows, { passive: true });
    window.addEventListener('resize', updateArrows);
    updateArrows();

    // Roda mouse vertikal -> geser menu horizontal
    nav.addEventListener('wheel', (e) => {
      if (nav.scrollWidth <= nav.clientWidth || Math.abs(e.deltaY) <= Math.abs(e.deltaX)) return;
      nav.scrollLeft += e.deltaY;
      e.preventDefault();
    }, { passive: false });

    // Drag dengan mouse (sentuhan sudah native)
    let dragging = false, moved = false, startX = 0, startLeft = 0;
    nav.addEventListener('pointerdown', (e) => {
      if (e.pointerType !== 'mouse') return;
      dragging = true; moved = false; startX = e.clientX; startLeft = nav.scrollLeft;
    });
    window.addEventListener('pointermove', (e) => {
      if (!dragging) return;
      const dx = e.clientX - startX;
      if (Math.abs(dx) > 4) { moved = true; nav.classList.add('dragging'); }
      if (moved) nav.scrollLeft = startLeft - dx;
    });
    window.addEventListener('pointerup', () => { dragging = false; nav.classList.remove('dragging'); });
    nav.addEventListener('click', (e) => {
      if (moved) { e.preventDefault(); e.stopPropagation(); moved = false; }
    }, true);

    // Tandai menu aktif sesuai section yang sedang dilihat
    const links = $$('a[href^="#"]', nav);
    const setActive = (id) => {
      links.forEach((a) => {
        const on = a.getAttribute('href') === '#' + id;
        a.classList.toggle('active', on);
        if (on) {
          a.setAttribute('aria-current', 'true');
          nav.scrollTo({ left: a.offsetLeft - (nav.clientWidth - a.offsetWidth) / 2, behavior: reduceMotion ? 'auto' : 'smooth' });
        } else {
          a.removeAttribute('aria-current');
        }
      });
    };
    if ('IntersectionObserver' in window) {
      const io = new IntersectionObserver((entries) => {
        entries.forEach((en) => { if (en.isIntersecting) setActive(en.target.id); });
      }, { rootMargin: '-45% 0px -50% 0px' });
      links.map((a) => $(a.getAttribute('href'))).filter(Boolean).forEach((el) => io.observe(el));
    }
  }

  /* ---------- Animasi pindah halaman (klik menu / tombol #anchor) ---------- */
  const curtain = $('#pageCurtain');
  function goTo(hash) {
    const target = $(hash);
    if (!target) return;
    if (reduceMotion || !curtain) { target.scrollIntoView(); return; }
    curtain.classList.add('show');
    setTimeout(() => {
      target.scrollIntoView({ behavior: 'instant' });
      history.replaceState(null, '', hash);
      curtain.classList.remove('show');
      target.classList.remove('pop');
      void target.offsetWidth; // restart animasi
      target.classList.add('pop');
    }, 230);
  }
  $$('a[href^="#"]').forEach((a) => a.addEventListener('click', (e) => {
    const hash = a.getAttribute('href');
    if (hash.length > 1 && $(hash)) { e.preventDefault(); goTo(hash); }
  }));

  /* ---------- Tombol kembali ke atas ---------- */
  const topBtn = $('#backToTop');
  if (topBtn) {
    window.addEventListener('scroll', () => topBtn.classList.toggle('show', window.scrollY > 400), { passive: true });
    topBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
  }

  /* ---------- Pencarian & filter (proyek, blog, testimoni) ---------- */
  $$('[data-filter]').forEach((box) => {
    const items = $$('.filterItem', box);
    const search = $('input[type=search]', box);
    const chips = $$('.chip[data-tag]', box);
    const empty = $('.filterEmpty', box);
    let tag = '';

    const run = () => {
      const q = (search ? search.value : '').trim().toLowerCase();
      let shown = 0;
      items.forEach((item) => {
        const okText = !q || item.dataset.search.includes(q);
        const okTag = !tag || item.dataset.tags.split('|').includes(tag);
        item.hidden = !(okText && okTag);
        if (!item.hidden) shown++;
      });
      if (empty) empty.hidden = shown > 0;
    };

    if (search) search.addEventListener('input', run);
    chips.forEach((chip) => chip.addEventListener('click', () => {
      tag = chip.dataset.tag;
      chips.forEach((c) => c.classList.toggle('active', c === chip));
      run();
    }));
  });

  /* ---------- Lightbox gambar ---------- */
  const lightbox = $('#lightbox');
  const lightboxImg = lightbox && $('img', lightbox);
  const openLightbox = (src, alt) => {
    if (!lightbox) return;
    lightboxImg.src = src;
    lightboxImg.alt = alt || '';
    lightbox.showModal();
  };
  document.addEventListener('click', (e) => {
    const img = e.target.closest('[data-lightbox]');
    if (img) openLightbox(img.currentSrc || img.src, img.alt);
  });
  if (lightbox) lightbox.addEventListener('click', () => lightbox.close());

  /* ---------- Preview proyek ---------- */
  const modal = $('#projectModal');
  if (modal && Array.isArray(window.PROJECTS)) {
    const body = $('.modalContent', modal);
    const make = (tag, text, cls) => {
      const node = document.createElement(tag);
      if (cls) node.className = cls;
      if (text != null) node.textContent = text;
      return node;
    };
    const section = (title, content) => {
      if (!content || (Array.isArray(content) && !content.length)) return;
      body.appendChild(make('h4', title));
      if (Array.isArray(content)) {
        const ul = make('ul');
        content.forEach((line) => ul.appendChild(make('li', line)));
        body.appendChild(ul);
      } else {
        body.appendChild(make('p', content, 'prewrap'));
      }
    };

    const render = (p) => {
      body.replaceChildren();
      if (p.image) {
        const img = make('img', null, 'cover');
        img.src = p.image; img.alt = p.title;
        body.appendChild(img);
      }
      body.appendChild(make('h2', p.title));
      if (p.tech.length) {
        const chips = make('div', null, 'chips');
        p.tech.forEach((t) => chips.appendChild(make('span', t, 'chip static')));
        body.appendChild(chips);
      }
      section('Deskripsi', p.desc);
      section('Permasalahan yang diselesaikan', p.problem);
      section('Tujuan proyek', p.goal);
      section('Peran dalam proyek', p.role);
      section('Fitur-fitur', p.features);
      section('Dokumentasi proses pekerjaan', p.process);
      if (p.docs.length) {
        const gallery = make('div', null, 'modalGallery');
        p.docs.forEach((src) => {
          const img = make('img');
          img.src = src; img.alt = 'Dokumentasi ' + p.title; img.loading = 'lazy';
          img.setAttribute('data-lightbox', '');
          gallery.appendChild(img);
        });
        body.appendChild(gallery);
      }
      section('Detail proyek', p.detail);
      section('Feedback user', p.feedback);
      if (p.demo_url || p.source_url) {
        const row = make('div', null, 'btnRow');
        [['Lihat Demo', p.demo_url, 'btn'], ['Source Code', p.source_url, 'btn ghost']].forEach(([label, href, cls]) => {
          if (!href) return;
          const a = make('a', label, cls);
          a.href = href; a.target = '_blank'; a.rel = 'noopener noreferrer';
          row.appendChild(a);
        });
        body.appendChild(row);
      }
    };

    $$('[data-preview]').forEach((btn) => btn.addEventListener('click', () => {
      const project = window.PROJECTS.find((p) => String(p.id) === btn.dataset.preview);
      if (!project) return;
      render(project);
      modal.showModal();
      modal.scrollTop = 0;
    }));
    $('.modalClose', modal).addEventListener('click', () => modal.close());
    modal.addEventListener('click', (e) => { if (e.target === modal) modal.close(); });
  }

  /* ---------- CV: cetak / simpan PDF ---------- */
  const printBtn = $('#printCv');
  if (printBtn) printBtn.addEventListener('click', () => window.print());
})();
