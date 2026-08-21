
        []
        const IMAGENES = 123;
        const SWATCHES = ["#111111","#374151","#9ca3af"];
        const REVIEWS_LIST = [{"author":"S***h","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"La estabilización mecánica en 3 ejes y la calidad nocturna del sensor de 1 pulgada superan cualquier expectativa. Para vlogs y viajes es insuperable.","date":"2026.04.12"},{"author":"s***m","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"El micrófono inalámbrico DJI Mic 2 se empareja de inmediato y el audio es súper profesional. Llegó rapidísimo en Bogotá.","date":"2026.05.02"},{"author":"j***5","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"Very nice, la rotación de pantalla horizontal a vertical enciende la cámara en 1 segundo. Seguimiento ActiveTrack 6.0 perfecto.","date":"2026.05.18"},{"author":"T***m","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"Pagué contraentrega cuando lo recibí en mi casa. Empaque 100% sellado y original con garantía directa.","date":"2026.06.01"},{"author":"B***i","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"Ultra portátil, cabe en el bolsillo de la chaqueta y graba en D-Log M de 10 bits con colores cinematográficos. DJI nunca decepciona.","date":"2026.06.14"},{"author":"A***r","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"Increíble rendimiento con poca luz. Los colores se ven vivos y naturales sin necesidad de edición pesada.","date":"2026.06.20"},{"author":"K***y","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"El mango con batería extra duplica la duración. Hice un viaje completo de fin de semana sin preocuparme por cargador.","date":"2026.06.28"},{"author":"M***o","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"El modo vertical nativo para TikTok e Instagram Reels ahorra horas de edición. 10 de 10.","date":"2026.07.05"},{"author":"F***e","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"Envío seguro y atención impecable por WhatsApp. Producto 100% original.","date":"2026.07.12"},{"author":"L***a","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"Excelente producto, la calidad de construcción en aleación y el tacto del joystick son de gama premium.","date":"2026.07.19"}];
        const PRECIO_UNITARIO = 1850000;
        const PRODUCTO_TITULO = "DJI Osmo Pocket 3 Creator Combo | Cámara Gimbal 4K 120fps Sensor 1\"";
        const LANDING_TOKEN = "sample";
        const LANDING_SLUG = "dji-osmo-pocket-3";
        const CHECKOUT_URL = "123/checkout.php?token=" + LANDING_TOKEN;
        const ES_MODO_EDICION = 123;

        let activeImgIndex = 0;
        let lightboxIndex = 0;
        let currentReviewPage = 1;
        const REVIEWS_PER_PAGE = 5;
        let cartState = { qty: 0, hasAdded: false, variant: "Creator Combo", size: "Kit Completo 6 en 1" };

        function toggleNavMenu() {
            const overlay = document.getElementById('navMenuOverlay');
            if (!overlay) return;
            const isOpen = overlay.classList.toggle('open');
            document.body.style.overflow = isOpen ? 'hidden' : '';
        }

        function navegarSeccion(e, targetId) {
            if (e) e.preventDefault();
            toggleNavMenu();
            const target = document.getElementById(targetId);
            if (target) {
                setTimeout(() => {
                    const navbar = document.querySelector('.navbar');
                    const navHeight = navbar ? navbar.offsetHeight : 70;
                    const targetPos = target.getBoundingClientRect().top + window.pageYOffset - (navHeight + 8);
                    window.scrollTo({ top: Math.max(0, targetPos), behavior: 'smooth' });
                }, 180);
            }
        }

        function initGallery() {
            const mainImg = document.getElementById('mainImage');
            const dotsContainer = document.getElementById('galleryDotsIndicator');
            const thumbsStrip = document.getElementById('galleryThumbsStrip');

            if (dotsContainer) dotsContainer.innerHTML = '';
            if (thumbsStrip) thumbsStrip.innerHTML = '';
            if (IMAGENES.length > 0 && mainImg) mainImg.src = IMAGENES[0];

            // Punticos (solo móvil)
            if (dotsContainer) {
                IMAGENES.forEach((src, idx) => {
                    const dot = document.createElement('div');
                    dot.className = 'gallery-dot' + (idx === 0 ? ' active' : '');
                    dot.onclick = () => seleccionarImagen(idx);
                    dot.setAttribute('title', `Imagen ${idx + 1}`);
                    dotsContainer.appendChild(dot);
                });
            }

            // Miniaturas desktop
            if (thumbsStrip) {
                IMAGENES.forEach((src, idx) => {
                    const thumb = document.createElement('div');
                    thumb.className = 'gallery-thumb-item' + (idx === 0 ? ' active' : '');
                    thumb.onclick = () => seleccionarImagen(idx);
                    thumb.setAttribute('title', `Imagen ${idx + 1}`);
                    thumb.innerHTML = `<img src="${src}" alt="Imagen ${idx + 1}" loading="lazy">`;
                    thumbsStrip.appendChild(thumb);
                });
            }
        }

        function seleccionarImagen(idx) {
            if (idx < 0 || idx >= IMAGENES.length) return;
            activeImgIndex = idx;
            const mainImg = document.getElementById('mainImage');
            if (mainImg) {
                // Fade out lento
                mainImg.style.opacity = '0';
                setTimeout(() => {
                    mainImg.src = IMAGENES[idx];
                    // Fade in lento cuando la imagen carga
                    mainImg.onload = () => { mainImg.style.opacity = '1'; };
                    // Fallback: mostrar aunque no haya evento onload
                    setTimeout(() => { mainImg.style.opacity = '1'; }, 100);
                }, 350);
            }
            // Sincronizar dots (móvil)
            document.querySelectorAll('.gallery-dot').forEach((el, i) => el.classList.toggle('active', i === idx));
            // Sincronizar thumbnails (desktop)
            document.querySelectorAll('.gallery-thumb-item').forEach((el, i) => el.classList.toggle('active', i === idx));
        }

        function cambiarImagenRelativa(step) {
            let next = (activeImgIndex + step + IMAGENES.length) % IMAGENES.length;
            seleccionarImagen(next);
        }

        function abrirLightbox(idx) {
            if (ES_MODO_EDICION) return;
            lightboxIndex = (idx !== undefined) ? idx : activeImgIndex;
            const modal = document.getElementById('imageLightbox');
            const img = document.getElementById('lightboxImage');
            const thumbsContainer = document.getElementById('lightboxThumbs');
            if (img) {
                img.classList.remove('zoomed');
                img.style.transformOrigin = 'center center';
                if (IMAGENES[lightboxIndex]) img.src = IMAGENES[lightboxIndex];
            }
            if (thumbsContainer) {
                thumbsContainer.innerHTML = '';
                IMAGENES.forEach((src, i) => {
                    const t = document.createElement('div');
                    t.className = 'lightbox-thumb' + (i === lightboxIndex ? ' active' : '');
                    t.onclick = () => setLightboxImage(i);
                    t.innerHTML = `<img src="${src}">`;
                    thumbsContainer.appendChild(t);
                });
            }
            if (modal) modal.classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function setLightboxImage(idx) {
            lightboxIndex = idx;
            const img = document.getElementById('lightboxImage');
            if (img) {
                img.classList.remove('zoomed');
                img.style.transformOrigin = 'center center';
                if (IMAGENES[idx]) img.src = IMAGENES[idx];
            }
            document.querySelectorAll('.lightbox-thumb').forEach((el, i) => el.classList.toggle('active', i === idx));
        }

        function cambiarImagenLightbox(delta) {
            let next = (lightboxIndex + delta + IMAGENES.length) % IMAGENES.length;
            setLightboxImage(next);
        }

        function toggleLightboxZoom(e) {
            if (!window.matchMedia('(min-width: 1025px) and (hover: hover)').matches) return;
            const img = document.getElementById('lightboxImage');
            if (!img) return;
            img.classList.toggle('zoomed');
            if (img.classList.contains('zoomed')) {
                actualizarPosicionZoom(e, img);
            } else {
                img.style.transformOrigin = 'center center';
            }
        }

        function actualizarPosicionZoom(e, img) {
            if (!img || !img.classList.contains('zoomed')) return;
            const rect = img.getBoundingClientRect();
            const x = Math.max(0, Math.min(100, ((e.clientX - rect.left) / rect.width) * 100));
            const y = Math.max(0, Math.min(100, ((e.clientY - rect.top) / rect.height) * 100));
            img.style.transformOrigin = `${x}% ${y}%`;
        }

        function cerrarLightbox() {
            const modal = document.getElementById('imageLightbox');
            const img = document.getElementById('lightboxImage');
            if (img) img.classList.remove('zoomed');
            if (modal) modal.classList.remove('open');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', (e) => {
            const modal = document.getElementById('imageLightbox');
            if (modal && modal.classList.contains('open')) {
                if (e.key === 'Escape') cerrarLightbox();
                if (e.key === 'ArrowLeft') cambiarImagenLightbox(-1);
                if (e.key === 'ArrowRight') cambiarImagenLightbox(1);
            }
        });

        function initSwatches() {
            const container = document.getElementById('swatchesContainer');
            if (!container) return;
            container.innerHTML = '';
            SWATCHES.forEach((colorHex, idx) => {
                const swatch = document.createElement('div');
                swatch.className = 'swatch-circle' + (idx === 0 ? ' active' : '');
                swatch.style.background = colorHex;
                swatch.onclick = () => {
                    document.querySelectorAll('.swatch-circle').forEach(s => s.classList.remove('active'));
                    swatch.classList.add('active');
                };
                container.appendChild(swatch);
            });
        }

        function toggleAccordion(btn) {
            const body = btn.nextElementSibling;
            if (body) {
                body.classList.toggle('open');
                const arrow = btn.querySelector('span:last-child');
                if (arrow) arrow.textContent = body.classList.contains('open') ? '▾' : '▸';
            }
        }

                                const CART_STORAGE_KEY = 'tridente_global_cart';
        let globalCart = [];

        function cargarCarritoStorage() {
            try {
                const saved = localStorage.getItem(CART_STORAGE_KEY);
                if (saved) {
                    const parsed = JSON.parse(saved);
                    if (Array.isArray(parsed)) {
                        globalCart = parsed.filter(item => item && item.qty > 0).map(item => {
                            let itemImg = item.image || '';
                            if (itemImg && !itemImg.startsWith('http://') && !itemImg.startsWith('https://') && !itemImg.startsWith('/')) {
                                itemImg = window.location.origin + '/' + itemImg.replace(/^\.\//, '');
                            }
                            let itemToken = (typeof LANDING_SLUG !== 'undefined' && item.slug === LANDING_SLUG && typeof LANDING_TOKEN !== 'undefined') ? LANDING_TOKEN : (item.token || LANDING_TOKEN);
                            return {
                                token: itemToken,
                                slug: item.slug || '',
                                title: item.title || 'Producto',
                                price: Number(item.price) || 0,
                                image: itemImg,
                                variant: item.variant || '',
                                size: item.size || '',
                                qty: Math.min(10, Math.max(1, Number(item.qty) || 1))
                            };
                        });
                        return;
                    }
                }
            } catch (e) {}
            globalCart = [];
        }

        function guardarCarritoEnStorage() {
            try {
                localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(globalCart));
            } catch (e) {}
        }

        function obtenerItemActual() {
            return globalCart.find(i => i.token === LANDING_TOKEN);
        }

        function toggleCart() {
            if (ES_MODO_EDICION) return;
            const overlay = document.getElementById('cartOverlay');
            if (!overlay) return;
            const isOpen = overlay.classList.toggle('open');
            document.body.style.overflow = isOpen ? 'hidden' : '';
            renderCart();
        }

        function animarVueloAlCarrito(btn, callback) {
            const cartTrigger = document.querySelector('.cart-trigger');
            const mainImg = document.getElementById('mainImage');
            let imgSrc = mainImg ? mainImg.src : ((typeof IMAGENES !== 'undefined' && IMAGENES.length > 0) ? IMAGENES[0] : 'producto.png');
            try { imgSrc = new URL(imgSrc, window.location.href).href; } catch(e) {}

            const activeBtn = btn || document.querySelector('.btn-add-desktop') || document.getElementById('btnAddToCart');
            const origBtnHtml = activeBtn ? activeBtn.innerHTML : '';

            if (activeBtn) {
                activeBtn.style.transition = 'all 0.2s ease';
                activeBtn.style.transform = 'scale(0.97)';
                activeBtn.innerHTML = `
                    <div style="display:flex; align-items:center; justify-content:center; width:100%; height:100%; overflow:hidden;">
                        <dotlottie-player src="https://lottie.host/b86261fc-a05c-4c50-a871-4f9ed870ec53/OwNQtMEoZd.lottie" background="transparent" speed="1.2" style="width:48px; height:48px;" autoplay></dotlottie-player>
                    </div>
                `;
                setTimeout(() => { if (activeBtn) activeBtn.style.transform = 'scale(1)'; }, 180);
            }

            const btnRect = activeBtn ? activeBtn.getBoundingClientRect() : { left: window.innerWidth / 2, top: window.innerHeight / 2, width: 60, height: 60 };
            const startX = btnRect.left + (btnRect.width / 2) - 35;
            const startY = btnRect.top + (btnRect.height / 2) - 35;

            const flyWrap = document.createElement('div');
            flyWrap.style.position = 'fixed';
            flyWrap.style.left = '0';
            flyWrap.style.top = '0';
            flyWrap.style.zIndex = '999999';
            flyWrap.style.pointerEvents = 'none';
            flyWrap.style.transform = `translate3d(${startX}px, ${startY}px, 0) scale(0.6)`;
            flyWrap.style.opacity = '0';
            flyWrap.style.transition = 'transform 0.85s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.25s ease';

            const flyImg = document.createElement('img');
            flyImg.src = imgSrc;
            flyImg.style.width = '70px';
            flyImg.style.height = '70px';
            flyImg.style.borderRadius = '16px';
            flyImg.style.objectFit = 'cover';
            flyImg.style.border = '2.5px solid #ffffff';
            flyImg.style.boxShadow = '0 16px 40px rgba(0, 0, 0, 0.35)';
            flyImg.style.transition = 'transform 0.85s cubic-bezier(0.4, 0, 0.2, 1), border-radius 0.85s ease, opacity 0.85s ease';
            flyImg.style.transformOrigin = 'center center';

            flyWrap.appendChild(flyImg);
            document.body.appendChild(flyWrap);

            setTimeout(() => {
                flyWrap.style.opacity = '1';
                flyWrap.style.transform = `translate3d(${startX}px, ${startY}px, 0) scale(1)`;

                requestAnimationFrame(() => {
                    const cartRect = cartTrigger ? cartTrigger.getBoundingClientRect() : { left: window.innerWidth - 60, top: 20, width: 40, height: 40 };
                    const destX = cartRect.left + (cartRect.width / 2) - 18;
                    const destY = cartRect.top + (cartRect.height / 2) - 18;

                    flyWrap.style.transform = `translate3d(${destX}px, ${destY}px, 0) scale(0.45)`;
                    flyImg.style.borderRadius = '50%';
                    flyImg.style.transform = 'rotate(18deg)';
                    flyImg.style.opacity = '0.35';
                });
            }, 300);

            setTimeout(() => {
                if (flyWrap.parentNode) flyWrap.parentNode.removeChild(flyWrap);

                if (cartTrigger) {
                    const ripple = document.createElement('div');
                    ripple.className = 'cart-ripple-effect';
                    cartTrigger.appendChild(ripple);
                    setTimeout(() => { if (ripple.parentNode) ripple.parentNode.removeChild(ripple); }, 650);

                    cartTrigger.classList.add('cart-pop-active');
                    setTimeout(() => { cartTrigger.classList.remove('cart-pop-active'); }, 450);
                }

                if (activeBtn) {
                    activeBtn.innerHTML = origBtnHtml;
                }

                if (callback) callback();
            }, 1100);
        }

        function agregarAlCarrito(e) {
            if (ES_MODO_EDICION) return;
            let clickedBtn = null;
            if (e) {
                clickedBtn = e.currentTarget || (e.target ? e.target.closest('button') : null);
            }
            if (!clickedBtn) {
                clickedBtn = document.querySelector('.btn-add-desktop') || document.getElementById('btnAddToCart');
            }

            const mainImg = document.getElementById('mainImage');
            let imgSrc = mainImg ? mainImg.src : ((typeof IMAGENES !== 'undefined' && IMAGENES.length > 0) ? IMAGENES[0] : 'producto.png');
            try { imgSrc = new URL(imgSrc, window.location.href).href; } catch(e) {}

            const prodTitulo = (typeof PRODUCTO_TITULO !== 'undefined') ? PRODUCTO_TITULO : 'Producto';
            const precioUnit = (typeof PRECIO_UNITARIO !== 'undefined') ? PRECIO_UNITARIO : 0;
            const variantVal = (typeof cartState !== 'undefined' && cartState.variant) ? cartState.variant : 'Estándar';
            const sizeVal = (typeof cartState !== 'undefined' && cartState.size) ? cartState.size : 'Único';

            let existingIndex = globalCart.findIndex(i => i.token === LANDING_TOKEN);
            if (existingIndex !== -1) {
                if (globalCart[existingIndex].qty < 10) {
                    globalCart[existingIndex].qty += 1;
                } else {
                    globalCart[existingIndex].qty = 10;
                }
                globalCart[existingIndex].image = imgSrc; // Asegurar miniatura absoluta
                globalCart[existingIndex].variant = variantVal;
                globalCart[existingIndex].size = sizeVal;
            } else {
                globalCart.push({
                    token: LANDING_TOKEN,
                    slug: typeof LANDING_SLUG !== 'undefined' ? LANDING_SLUG : '',
                    title: prodTitulo,
                    price: precioUnit,
                    image: imgSrc,
                    variant: variantVal,
                    size: sizeVal,
                    qty: 1
                });
            }

            guardarCarritoEnStorage();
            actualizarControlesPagina();

            animarVueloAlCarrito(clickedBtn, () => {
                renderCart();
                const overlay = document.getElementById('cartOverlay');
                if (overlay && !overlay.classList.contains('open')) {
                    overlay.classList.add('open');
                    document.body.style.overflow = 'hidden';
                }
            });
        }

        function cambiarCantidadItem(token, delta) {
            let idx = globalCart.findIndex(i => i.token === token);
            if (idx !== -1) {
                let newQty = globalCart[idx].qty + delta;
                if (newQty > 10) newQty = 10;
                if (newQty <= 0) {
                    globalCart.splice(idx, 1);
                } else {
                    globalCart[idx].qty = newQty;
                }
            }
            guardarCarritoEnStorage();
            actualizarControlesPagina();
            renderCart();
        }

        function cambiarCantidad(delta) {
            cambiarCantidadItem(LANDING_TOKEN, delta);
        }

        function actualizarControlesPagina() {
            const currentItem = obtenerItemActual();
            const currentQty = currentItem ? currentItem.qty : 0;

            const desktopQty = document.getElementById('qtyDesktopDisplay');
            if (desktopQty) desktopQty.textContent = Math.max(1, currentQty);

            const mobileBtn = document.getElementById('btnAddToCart');
            if (mobileBtn) {
                mobileBtn.textContent = 'Añadir al carro';
            }
            const desktopBtn = document.querySelector('.btn-add-desktop');
            if (desktopBtn) {
                desktopBtn.textContent = 'Añadir al carro';
            }
        }

        function formatMoney(num) {
            return '$ ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function renderCart() {
            const container = document.getElementById('cartItemsContainer');
            const totalUnits = globalCart.reduce((sum, item) => sum + (item.qty || 0), 0);
            const subtotalMoney = globalCart.reduce((sum, item) => sum + ((item.price || 0) * (item.qty || 0)), 0);
            const fmtTotal = formatMoney(subtotalMoney);

            const badge = document.getElementById('cartBadge');
            if (badge) {
                badge.textContent = totalUnits;
                badge.style.display = totalUnits > 0 ? 'flex' : 'none';
            }
            const drawerTitle = document.getElementById('cartDrawerTitle');
            if (drawerTitle) drawerTitle.textContent = `Tu Carrito (${totalUnits})`;
            const subtotalEl = document.getElementById('cartSubtotal');
            if (subtotalEl) subtotalEl.textContent = fmtTotal;
            const totalEl = document.getElementById('cartTotal');
            if (totalEl) totalEl.textContent = fmtTotal;

            const checkoutBtn = document.querySelector('.btn-checkout');
            if (checkoutBtn) {
                if (globalCart.length === 0 || totalUnits <= 0) {
                    checkoutBtn.style.opacity = '0.45';
                    checkoutBtn.style.pointerEvents = 'none';
                    checkoutBtn.innerHTML = `<span>Carrito Vacío</span>`;
                } else {
                    checkoutBtn.style.opacity = '1';
                    checkoutBtn.style.pointerEvents = 'auto';
                    checkoutBtn.innerHTML = `
                        <span>Finalizar Compra Segura</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    `;
                }
            }

            if (container) {
                if (globalCart.length === 0 || totalUnits <= 0) {
                    container.innerHTML = `
                        <div style="text-align: center; padding: 48px 20px; color: var(--text-muted);">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin: 0 auto 12px auto; display: block; opacity: 0.4;">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg>
                            <p style="font-size: 15px; font-weight: 700; margin: 0 0 6px 0; color: var(--text-main);">Tu carrito está vacío</p>
                            <p style="font-size: 13px; margin: 0;">Agrega productos para continuar con tu compra.</p>
                        </div>
                    `;
                } else {
                    container.innerHTML = globalCart.map(item => `
                        <div class="cart-item" data-token="${item.token}">
                            <img src="${item.image}" class="cart-item-img" alt="${item.title}">
                            <div class="cart-item-info">
                                <div>
                                    <div class="cart-item-title">${item.title}</div>
                                    <div class="cart-item-variant">Variante: ${item.variant} | ${item.size}</div>
                                </div>
                                <div class="cart-item-bottom">
                                    <div class="cart-item-price">${formatMoney(item.price)}</div>
                                    <div class="qty-controls">
                                        <button class="qty-btn" onclick="cambiarCantidadItem('${item.token}', -1)">-</button>
                                        <span class="qty-value">${item.qty}</span>
                                        <button class="qty-btn" onclick="cambiarCantidadItem('${item.token}', 1)" ${item.qty >= 10 ? 'style="opacity:0.4;cursor:not-allowed;"' : ''}>+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `).join('');
                }
            }
        }

        function procederAlCheckout() {
            if (!globalCart || globalCart.length === 0) return;
            const loader = document.getElementById('landing-loader');
            if (loader) loader.style.display = 'flex';
            
            const primaryItem = globalCart.find(i => i.token === LANDING_TOKEN) || globalCart[0];
            const tokensList = globalCart.map(i => `${i.token}:${i.qty}`).join(',');
            
            const targetUrl = CHECKOUT_URL + '&qty=' + primaryItem.qty + '&cart_tokens=' + encodeURIComponent(tokensList);
            setTimeout(() => { window.location.href = targetUrl; }, 350);
        }

        // ─── SISTEMA DE OPINIONES DE CLIENTES (LOCALSTORAGE + ESTADÍSTICAS AMAZON) ───
        const USER_REVIEWS_KEY = 'dji_user_custom_reviews_v1';
        let selectedStarRating = 5;
        const starLabelsMap = {
            1: "Malo (1 de 5)",
            2: "Regular (2 de 5)",
            3: "Bueno (3 de 5)",
            4: "Muy bueno (4 de 5)",
            5: "Excelente (5 de 5)"
        };

        function cargarOpinionesUsuario() {
            try {
                const saved = localStorage.getItem(USER_REVIEWS_KEY);
                if (saved) {
                    const parsed = JSON.parse(saved);
                    if (Array.isArray(parsed) && parsed.length > 0) {
                        // Prepend user reviews to the beginning of REVIEWS_LIST
                        parsed.forEach(ur => {
                            if (!REVIEWS_LIST.some(r => r.id && r.id === ur.id)) {
                                REVIEWS_LIST.unshift(ur);
                            }
                        });
                    }
                }
            } catch (e) {}
        }

        function setReviewModalView(viewId, titleText) {
            const views = document.querySelectorAll('.review-modal-view');
            views.forEach(v => v.classList.remove('active'));

            const targetView = document.getElementById(viewId);
            if (targetView) targetView.classList.add('active');

            const headerTitle = document.getElementById('modalReviewHeaderTitle');
            if (headerTitle) {
                // Solo mostrar título en el header si es la vista de escribir opinión para evitar duplicidad
                if (viewId === 'reviewModalViewWrite') {
                    headerTitle.textContent = titleText || 'Escribir opinión';
                    headerTitle.style.display = 'block';
                } else {
                    headerTitle.textContent = '';
                    headerTitle.style.display = 'none';
                }
            }
        }

        function mostrarVistaVerificarCompra() {
            setReviewModalView('reviewModalViewVerify', '');
            const receiptInput = document.getElementById('verifyReceiptNumber');
            if (receiptInput) receiptInput.focus();
        }

        function mostrarVistaEscribirOpinion() {
            setReviewModalView('reviewModalViewWrite', 'Escribir opinión');
        }

        function ejecutarVerificacionCompra(e) {
            if (e) e.preventDefault();
            const btn = document.getElementById('btnDoVerify');
            const origHtml = btn ? btn.innerHTML : 'Verificar';
            if (btn) {
                btn.innerHTML = '⏳ Verificando...';
                btn.disabled = true;
            }

            setTimeout(() => {
                if (btn) {
                    btn.innerHTML = origHtml;
                    btn.disabled = false;
                }
                setReviewModalView('reviewModalViewUpsell', '');
            }, 450);
        }

        function ejecutarCompraDesdeModal(e) {
            cerrarModalEscribirOpinion();
            agregarAlCarrito(e);
        }

        function abrirModalEscribirOpinion() {
            const modal = document.getElementById('writeReviewModal');
            if (modal) {
                mostrarVistaEscribirOpinion();
                modal.classList.add('open');
                document.body.style.overflow = 'hidden';
                selectStars(5);
                const nameInput = document.getElementById('reviewAuthorInput');
                if (nameInput) nameInput.focus();
            }
        }

        function cerrarModalEscribirOpinion() {
            const modal = document.getElementById('writeReviewModal');
            if (modal) {
                modal.classList.remove('open');
                document.body.style.overflow = '';
                // Restablecer a vista normal al cerrar
                setTimeout(mostrarVistaEscribirOpinion, 300);
            }
        }

        function hoverStars(val) {
            const stars = document.querySelectorAll('#starRatingPicker .star-pick');
            stars.forEach((s, idx) => {
                s.classList.toggle('hovered', idx < val);
            });
            const lbl = document.getElementById('starRatingLabel');
            if (lbl) lbl.textContent = starLabelsMap[val] || `${val} de 5`;
        }

        function resetStars() {
            const stars = document.querySelectorAll('#starRatingPicker .star-pick');
            stars.forEach((s, idx) => {
                s.classList.remove('hovered');
                s.classList.toggle('selected', idx < selectedStarRating);
            });
            const lbl = document.getElementById('starRatingLabel');
            if (lbl) lbl.textContent = starLabelsMap[selectedStarRating] || `${selectedStarRating} de 5`;
        }

        function selectStars(val) {
            selectedStarRating = val;
            const input = document.getElementById('reviewRatingInput');
            if (input) input.value = val;
            resetStars();
        }

        function toggleExplanationReviews(btn) {
            const box = document.getElementById('reviewsExplanationBox');
            if (box) {
                const isOpen = box.classList.toggle('open');
                const arrow = btn.querySelector('.explanation-arrow');
                if (arrow) arrow.textContent = isOpen ? '▴' : '▾';
            }
        }

        function filtrarPorEstrellasDirecto(starCount) {
            const selectRating = document.getElementById('filterRating');
            if (selectRating) {
                selectRating.value = starCount.toString();
                currentReviewPage = 1;
                renderReviews();
                const section = document.getElementById('customerReviewsSection');
                if (section) section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        function calcularEstadisticasReviews() {
            // Distribución realista estilo Amazon de 48 calificaciones globales
            const BASELINE_TOTAL = 48;
            const BASELINE_COUNTS = { 5: 38, 4: 6, 3: 2, 2: 1, 1: 1 };
            
            let userAddedCount = 0;
            const userAddedCounts = { 1: 0, 2: 0, 3: 0, 4: 0, 5: 0 };

            if (REVIEWS_LIST && Array.isArray(REVIEWS_LIST)) {
                REVIEWS_LIST.forEach(r => {
                    if (r.id || r.isUserCustom || r.isUserVerified) {
                        userAddedCount++;
                        let starCount = 5;
                        if (r.ratingNum) starCount = r.ratingNum;
                        else if (r.stars) starCount = (r.stars.match(/★/g) || []).length || 5;
                        starCount = Math.max(1, Math.min(5, starCount));
                        userAddedCounts[starCount] = (userAddedCounts[starCount] || 0) + 1;
                    }
                });
            }

            const total = BASELINE_TOTAL + userAddedCount;
            let sumStars = 0;
            const finalCounts = {};

            for (let s = 1; s <= 5; s++) {
                finalCounts[s] = (BASELINE_COUNTS[s] || 0) + (userAddedCounts[s] || 0);
                sumStars += finalCounts[s] * s;
            }

            const avg = (sumStars / total).toFixed(1);
            const avgDisplay = document.getElementById('scoreAvgDisplay');
            if (avgDisplay) avgDisplay.textContent = avg;

            const countDisplay = document.getElementById('reviewsTotalCountSub');
            if (countDisplay) {
                countDisplay.textContent = `${total} calificaciones globales`;
            }

            for (let s = 1; s <= 5; s++) {
                const pct = Math.round((finalCounts[s] / total) * 100);
                const barFill = document.getElementById(`barFill${s}`);
                const barPct = document.getElementById(`barPct${s}`);
                if (barFill) barFill.style.width = `${pct}%`;
                if (barPct) barPct.textContent = `${pct}%`;
            }
        }

        function guardarNuevaOpinion(e) {
            if (e) e.preventDefault();
            const authorInput = document.getElementById('reviewAuthorInput');
            const titleInput = document.getElementById('reviewTitleInput');
            const commentInput = document.getElementById('reviewCommentInput');

            const author = (authorInput ? authorInput.value.trim() : '') || 'Cliente Verificado';
            const title = titleInput ? titleInput.value.trim() : '';
            const comment = commentInput ? commentInput.value.trim() : '';
            const starsNum = selectedStarRating || 5;

            if (!comment) {
                alert('Por favor escribe un comentario para tu opinión.');
                return;
            }

            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const dateFormatted = `${year}.${month}.${day}`;

            let fullComment = comment;
            if (title) {
                fullComment = `<b>${title}</b><br>${comment}`;
            }

            const newReviewObj = {
                id: 'rev_' + Date.now(),
                author: author,
                color: "Creator Combo",
                size: "Kit Completo 6 en 1",
                stars: "★".repeat(starsNum) + "☆".repeat(5 - starsNum),
                ratingNum: starsNum,
                comment: fullComment,
                date: dateFormatted,
                isUserVerified: true
            };

            // Guardar en localStorage
            try {
                let savedReviews = [];
                const existing = localStorage.getItem(USER_REVIEWS_KEY);
                if (existing) savedReviews = JSON.parse(existing);
                savedReviews.unshift(newReviewObj);
                localStorage.setItem(USER_REVIEWS_KEY, JSON.stringify(savedReviews));
            } catch (err) {}

            // Añadir al inicio del arreglo en memoria
            REVIEWS_LIST.unshift(newReviewObj);

            // Limpiar formulario y cerrar modal
            if (authorInput) authorInput.value = '';
            if (titleInput) titleInput.value = '';
            if (commentInput) commentInput.value = '';
            cerrarModalEscribirOpinion();

            // Renderizar y saltar a la primera página
            currentReviewPage = 1;
            renderReviews();

            // Notificación elegante
            const alertBox = document.createElement('div');
            alertBox.style.cssText = 'position:fixed; bottom:24px; right:24px; background:#1d1d1f; color:#ffffff; padding:14px 20px; border-radius:12px; font-weight:600; font-size:14px; z-index:999999; box-shadow:0 10px 30px rgba(0,0,0,0.3); display:flex; align-items:center; gap:8px; animation: modalFadeIn 0.3s ease;';
            alertBox.innerHTML = '<span>✅</span> <span>¡Gracias! Tu opinión ha sido publicada exitosamente.</span>';
            document.body.appendChild(alertBox);
            setTimeout(() => { if (alertBox.parentNode) alertBox.parentNode.removeChild(alertBox); }, 3800);
        }

        function initReviewsScrollObserver() {
            const section = document.getElementById('customerReviewsSection');
            if (!section) return;

            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            section.classList.add('scroll-visible');
                            observer.unobserve(section);
                        }
                    });
                }, { threshold: 0.12 });
                observer.observe(section);
            } else {
                section.classList.add('scroll-visible');
            }
        }

        function renderReviews() {
            const container = document.getElementById('reviewsListContainer');
            const paginationContainer = document.getElementById('reviewsPaginationContainer');
            if (!container || !REVIEWS_LIST || REVIEWS_LIST.length === 0) return;

            const filterColor = document.getElementById('filterColor') ? document.getElementById('filterColor').value : 'All';
            const filterRating = document.getElementById('filterRating') ? document.getElementById('filterRating').value : 'All';
            const sortBy = document.getElementById('filterSort') ? document.getElementById('filterSort').value : 'Default';

            let filtered = [...REVIEWS_LIST];

            if (filterColor !== 'All') {
                filtered = filtered.filter(r => r.color === filterColor);
            }
            if (filterRating !== 'All') {
                const targetRating = parseInt(filterRating, 10);
                filtered = filtered.filter(r => {
                    const starsCount = r.ratingNum || (r.stars ? (r.stars.match(/★/g) || []).length : 5);
                    return starsCount === targetRating;
                });
            }
            if (sortBy === 'Most Recent') {
                filtered.sort((a, b) => b.date.localeCompare(a.date));
            }

            const totalPages = Math.max(1, Math.ceil(filtered.length / REVIEWS_PER_PAGE));
            if (currentReviewPage > totalPages) currentReviewPage = 1;

            const startIdx = (currentReviewPage - 1) * REVIEWS_PER_PAGE;
            const pageItems = filtered.slice(startIdx, startIdx + REVIEWS_PER_PAGE);

            container.innerHTML = '';
            if (pageItems.length === 0) {
                container.innerHTML = `
                    <div style="text-align:center; padding:36px 16px; color:#565959;">
                        <p style="font-size:15px; font-weight:600; margin-bottom:6px;">No hay opiniones que coincidan con los filtros seleccionados.</p>
                        <p style="font-size:13px; margin:0;">Sé el primero en <a href="javascript:void(0)" onclick="abrirModalEscribirOpinion()" style="color:#007185; font-weight:700; text-decoration:underline;">escribir una opinión</a>.</p>
                    </div>
                `;
            } else {
                pageItems.forEach(r => {
                    const item = document.createElement('div');
                    item.className = 'review-card-item';
                    item.innerHTML = `
                        <div class="reviewer-col">
                            <span class="reviewer-name" data-editable="true">
                                ${r.author}
                                <span class="reviewer-badge-verified">Compra verificada</span>
                            </span>
                            <span class="reviewer-meta" data-editable="true">Color: ${r.color || 'Creator Combo'}</span>
                            ${r.size ? `<span class="reviewer-meta" data-editable="true">Size: ${r.size}</span>` : ''}
                        </div>
                        <div class="review-content-col">
                            <div class="review-stars-row">${r.stars}</div>
                            <p class="review-comment-text" data-editable="true">${r.comment}</p>
                        </div>
                        <div class="review-date-badge" data-editable="true">${r.date}</div>
                    `;
                    container.appendChild(item);
                });
            }

            if (paginationContainer) {
                if (totalPages <= 1) {
                    paginationContainer.innerHTML = '';
                } else {
                    let pagesHtml = `<span>Total <b>${totalPages}</b> Páginas</span>`;
                    pagesHtml += `<button class="page-btn" onclick="cambiarPaginaReviews(${currentReviewPage - 1}, ${totalPages})" ${currentReviewPage === 1 ? 'disabled style="opacity:0.35;cursor:not-allowed;"' : ''}>&lt;</button>`;
                    
                    for (let i = 1; i <= totalPages; i++) {
                        pagesHtml += `<button class="page-btn ${i === currentReviewPage ? 'active' : ''}" onclick="cambiarPaginaReviews(${i}, ${totalPages})">${i}</button>`;
                    }

                    pagesHtml += `<button class="page-btn" onclick="cambiarPaginaReviews(${currentReviewPage + 1}, ${totalPages})" ${currentReviewPage === totalPages ? 'disabled style="opacity:0.35;cursor:not-allowed;"' : ''}>&gt;</button>`;
                    paginationContainer.innerHTML = pagesHtml;
                }
            }

            calcularEstadisticasReviews();
            initModoEdicion();
        }

        function cambiarPaginaReviews(nuevaPagina, totalPages) {
            if (nuevaPagina < 1 || nuevaPagina > totalPages) return;
            currentReviewPage = nuevaPagina;
            renderReviews();
            const section = document.getElementById('customerReviewsSection');
            if (section) {
                section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        function initModoEdicion() {
            if (!ES_MODO_EDICION) return;
            document.querySelectorAll('[data-editable="true"]').forEach(el => {
                el.addEventListener('dblclick', function(e) {
                    e.stopPropagation();
                    this.contentEditable = "true";
                    this.focus();
                });
                el.addEventListener('blur', function() { this.contentEditable = "false"; });
            });
        }

        async function guardarCambiosVisuales() {
            const btn = document.querySelector('.btn-editor-save');
            if (btn) {
                btn.innerHTML = '⏳ Guardando...';
                btn.disabled = true;
            }

            const docClone = document.documentElement.cloneNode(true);
            const tb = docClone.querySelector('#editorToolbar');
            if (tb) tb.remove();

            const bodyEl = docClone.querySelector('body');
            if (bodyEl) {
                bodyEl.classList.remove('modo-edicion-activo');
                bodyEl.style.marginTop = '';
            }

            const htmlToSave = '<!DOCTYPE html>' + docClone.outerHTML;

            const formData = new FormData();
            formData.append('slug', LANDING_SLUG);
            formData.append('html_content', htmlToSave);

            try {
                const res = await fetch('../../guardar_visual.php', { method: 'POST', body: formData });
                const data = await res.json();
                if (data.success) { alert('✅ ' + data.message); }
                else { alert('❌ Error: ' + data.message); }
            } catch (err) { alert('❌ Error de conexión al guardar los cambios'); }

            if (btn) {
                btn.innerHTML = '💾 Guardar Cambios';
                btn.disabled = false;
            }
        }

        // ─── CONTADOR DE ENVÍO URGENTE PERSISTENTE EN LOCALSTORAGE ───
        function initShippingCountdown() {
            const STORAGE_KEY = 'dji_shipping_countdown_deadline_v1';
            let deadline = localStorage.getItem(STORAGE_KEY);
            const now = Date.now();

            // Si no existe o ya venció, establecer 20 horas y 40 minutos en el futuro
            if (!deadline || isNaN(parseInt(deadline, 10)) || parseInt(deadline, 10) <= now) {
                const duracionMs = (20 * 3600 + 40 * 60) * 1000;
                deadline = now + duracionMs;
                localStorage.setItem(STORAGE_KEY, deadline.toString());
            } else {
                deadline = parseInt(deadline, 10);
            }

            function actualizarDisplay() {
                const actual = Date.now();
                let restante = deadline - actual;

                if (restante <= 0) {
                    const duracionMs = (20 * 3600 + 40 * 60) * 1000;
                    deadline = actual + duracionMs;
                    localStorage.setItem(STORAGE_KEY, deadline.toString());
                    restante = deadline - actual;
                }

                const h = Math.floor(restante / (1000 * 60 * 60));
                const m = Math.floor((restante % (1000 * 60 * 60)) / (1000 * 60));
                const s = Math.floor((restante % (1000 * 60)) / 1000);

                const el = document.getElementById('shippingCountdown');
                if (el) {
                    el.textContent = `${h} h ${m < 10 ? '0' + m : m} min ${s < 10 ? '0' + s : s} s`;
                }
            }

            actualizarDisplay();
            setInterval(actualizarDisplay, 1000);
        }

        // ─── SLIDER Y PUNTICOS PARA 'QUIENES VIERON ESTE PRODUCTO TAMBIÉN COMPRARON' ───
        function initRecommendedProductsSlider() {
            const track = document.getElementById('recommendedProductsTrack');
            const dotsContainer = document.getElementById('recommendedProductsDots');
            if (!track || !dotsContainer) return;

            const cards = track.querySelectorAll('.more-card');
            if (cards.length === 0) return;

            dotsContainer.innerHTML = '';
            cards.forEach((card, idx) => {
                const dot = document.createElement('div');
                dot.className = 'more-prod-dot' + (idx === 0 ? ' active' : '');
                dot.setAttribute('title', `Producto ${idx + 1}`);
                dot.onclick = () => {
                    card.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                };
                dotsContainer.appendChild(dot);
            });

            track.addEventListener('scroll', () => {
                const scrollLeft = track.scrollLeft;
                const cardWidth = cards[0].offsetWidth + 16;
                const activeIdx = Math.min(cards.length - 1, Math.max(0, Math.round(scrollLeft / cardWidth)));
                dotsContainer.querySelectorAll('.more-prod-dot').forEach((dot, i) => {
                    dot.classList.toggle('active', i === activeIdx);
                });
            }, { passive: true });
        }

        function slideRecommendedProducts(delta) {
            const track = document.getElementById('recommendedProductsTrack');
            if (!track) return;
            const card = track.querySelector('.more-card');
            const scrollAmount = card ? (card.offsetWidth + 16) * 1.5 : 300;
            track.scrollBy({ left: delta * scrollAmount, behavior: 'smooth' });
        }

        // ─── SCROLL DINÁMICO: OCULTAR/MOSTRAR NAVBAR Y STICKY ADD TO CART ───
        (function() {
            let lastScrollY = 0;
            let ticking = false;

            function updateNavScroll() {
                const currentScrollY = Math.max(0, window.scrollY || window.pageYOffset || document.documentElement.scrollTop || 0);
                const navbar = document.querySelector('.navbar');
                const stickyBar = document.querySelector('.sticky-footer-bar');
                const delta = currentScrollY - lastScrollY;

                if (currentScrollY <= 10) {
                    // En la cima → siempre visible
                    if (navbar) navbar.classList.remove('nav-hidden');
                    if (stickyBar) stickyBar.classList.remove('bar-hidden');
                } else if (delta < -2) {
                    // Scroll UP (delta negativo) → mostrar
                    if (navbar) navbar.classList.remove('nav-hidden');
                    if (stickyBar) stickyBar.classList.remove('bar-hidden');
                } else if (delta > 4 && currentScrollY > 60) {
                    // Scroll DOWN (delta positivo, superada zona inicial) → ocultar
                    if (navbar) navbar.classList.add('nav-hidden');
                    if (stickyBar) stickyBar.classList.add('bar-hidden');
                }

                lastScrollY = currentScrollY;
                ticking = false;
            }

            function onScroll() {
                if (!ticking) {
                    ticking = true;
                    window.requestAnimationFrame(updateNavScroll);
                }
            }

            window.addEventListener('scroll', onScroll, { passive: true });
        })();

        document.addEventListener('DOMContentLoaded', () => {
            cargarCarritoStorage();
            cargarOpinionesUsuario();
            actualizarControlesPagina();
            initGallery();
            initSwatches();
            renderCart();
            renderReviews();
            initModoEdicion();
            initShippingCountdown();
            initRecommendedProductsSlider();
            initReviewsScrollObserver();
        });
    
        // ─── GESTOS TÁCTILES (SWIPE) PARA MÓVIL EN GALERÍA Y LIGHTBOX ───
        (function() {
            function habilitarSwipe(elem, accionIzquierda, accionDerecha) {
                if (!elem) return;
                let startX = 0, startY = 0;
                elem.addEventListener('touchstart', function(e) {
                    if (e.touches && e.touches.length === 1) {
                        startX = e.touches[0].clientX;
                        startY = e.touches[0].clientY;
                    }
                }, { passive: true });
                elem.addEventListener('touchend', function(e) {
                    if (e.changedTouches && e.changedTouches.length === 1) {
                        let diffX = e.changedTouches[0].clientX - startX;
                        let diffY = e.changedTouches[0].clientY - startY;
                        if (Math.abs(diffX) > 35 && Math.abs(diffX) > Math.abs(diffY)) {
                            if (diffX < 0) {
                                accionIzquierda();
                            } else {
                                accionDerecha();
                            }
                        }
                    }
                }, { passive: true });
            }

            document.addEventListener('DOMContentLoaded', function() {
                const mainWrap = document.querySelector('.main-image-wrap');
                if (mainWrap) {
                    habilitarSwipe(mainWrap, () => cambiarImagenRelativa(1), () => cambiarImagenRelativa(-1));
                }

                const lbView = document.getElementById('imageLightbox');
                if (lbView) {
                    habilitarSwipe(lbView, () => cambiarImagenLightbox(1), () => cambiarImagenLightbox(-1));
                }
            });
        })();

        // ─── 5.2 FUNCIONES PARA REVIEWS CON VIDEO Y REPRODUCTOR YOUTUBE ───
        function extraerYouTubeId(url) {
            if (!url) return '';
            url = url.trim();
            const regExp = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=|shorts\/)|youtu\.be\/)([^"&?\/\s]{11})/;
            const match = url.match(regExp);
            if (match && match[1]) return match[1];
            if (url.length === 11 && !url.includes('/') && !url.includes('.')) return url;
            return url;
        }

        function abrirVideoModal(youtubeId) {
            const modal = document.getElementById('videoModalLightbox');
            const iframe = document.getElementById('videoModalIframe');
            if (!modal || !iframe || !youtubeId) return;
            iframe.src = 'https://www.youtube.com/embed/' + youtubeId + '?autoplay=1&rel=0&modestbranding=1&playsinline=1';
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function cerrarVideoModal(e) {
            if (e && e.target && e.target.classList && e.target.classList.contains('video-modal-container')) {
                return;
            }
            if (e) e.stopPropagation();
            const modal = document.getElementById('videoModalLightbox');
            const iframe = document.getElementById('videoModalIframe');
            if (!modal) return;
            modal.classList.remove('active');
            if (iframe) iframe.src = '';
            document.body.style.overflow = '';
        }

        function manejarClickVideoCard(card, event) {
            if (typeof ES_MODO_EDICION !== 'undefined' && ES_MODO_EDICION) {
                return;
            }
            const ytid = card.getAttribute('data-youtube-id');
            if (ytid) {
                abrirVideoModal(ytid);
            }
        }

        function desplazarVideoCarrusel(direccion) {
            const track = document.getElementById('videoReviewsTrack');
            if (track) {
                track.scrollBy({ left: direccion * 320, behavior: 'smooth' });
            }
        }

        function editarVideoCard(card) {
            if (!card) return;
            const currentId = card.getAttribute('data-youtube-id') || '';
            const currentDurElem = card.querySelector('.video-duration-text');
            const currentTitleElem = card.querySelector('.video-card-title-text');
            
            const currentDur = currentDurElem ? currentDurElem.innerText.trim() : '1:30';
            const currentTitle = currentTitleElem ? currentTitleElem.innerText.trim() : 'Review DJI Pocket 3';

            const newUrl = prompt('Ingresa el Link de YouTube o ID del video:\n(Ej: https://www.youtube.com/watch?v=... o https://youtu.be/... o https://youtube.com/shorts/...)', currentId ? 'https://www.youtube.com/watch?v=' + currentId : '');
            if (newUrl === null) return;
            
            const parsedId = extraerYouTubeId(newUrl);
            if (!parsedId) {
                alert('No se pudo reconocer un ID de YouTube válido.');
                return;
            }

            const newDur = prompt('Duración del video (ej. 1:45):', currentDur) || currentDur;
            const newTitle = prompt('Título o descripción corta:', currentTitle) || currentTitle;

            card.setAttribute('data-youtube-id', parsedId);
            const thumb = card.querySelector('.video-card-thumb');
            if (thumb) {
                thumb.src = 'https://i.ytimg.com/vi/' + parsedId + '/hqdefault.jpg';
                thumb.setAttribute('referrerpolicy', 'no-referrer');
            }
            if (currentDurElem) currentDurElem.innerText = newDur;
            if (currentTitleElem) currentTitleElem.innerText = newTitle;

            alert('✅ Video actualizado. Recuerda hacer clic en "💾 Guardar Cambios" para guardar.');
        }

        function eliminarVideoCard(card) {
            if (!card) return;
            if (confirm('¿Estás seguro de eliminar este video del carrusel?')) {
                card.remove();
            }
        }

        function agregarNuevoVideoReview() {
            const url = prompt('Ingresa el link de YouTube del nuevo video:\n(Ej: https://www.youtube.com/watch?v=... o https://youtu.be/...)');
            if (!url) return;
            const id = extraerYouTubeId(url);
            if (!id) {
                alert('Link de YouTube no válido.');
                return;
            }
            const dur = prompt('Duración del video (ej. 1:30):', '1:30') || '1:30';
            const title = prompt('Título / Resumen:', 'Opinión DJI Osmo Pocket 3') || 'Opinión DJI Osmo Pocket 3';

            const track = document.getElementById('videoReviewsTrack');
            if (!track) return;

            const card = document.createElement('div');
            card.className = 'video-review-card';
            card.setAttribute('data-youtube-id', id);
            card.setAttribute('onclick', 'manejarClickVideoCard(this, event)');
            card.innerHTML = `
                <img class="video-card-thumb" src="https://i.ytimg.com/vi/${id}/hqdefault.jpg" referrerpolicy="no-referrer" alt="Video Review" loading="lazy">
                <div class="video-card-gradient"></div>
                <div class="video-card-badge-play">▶</div>
                <div class="video-card-info">
                    <div class="video-card-stars">★★★★★</div>
                    <div class="video-card-duration">
                        <span class="play-icon-mini">▶</span> <span class="video-duration-text" data-editable="true">${dur}</span>
                    </div>
                    <div class="video-card-title-text" data-editable="true">${title}</div>
                </div>
                <div class="video-card-admin-bar" onclick="event.stopPropagation()">
                    <button type="button" class="btn-vcard-edit" onclick="editarVideoCard(this.closest('.video-review-card'))" title="Editar link de YouTube">✏️ Editar</button>
                    <button type="button" class="btn-vcard-del" onclick="eliminarVideoCard(this.closest('.video-review-card'))" title="Eliminar video">🗑️</button>
                </div>
            `;
            track.appendChild(card);
            if (typeof initModoEdicion === 'function') {
                initModoEdicion();
            }
            alert('✅ Video agregado al carrusel. Recuerda hacer clic en "💾 Guardar Cambios" para guardar permanentemente.');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                cerrarVideoModal();
            }
        });

        // ─── ACTUALIZACIÓN EN TIEMPO REAL AL PUBLICAR NUEVA VERSIÓN ───
        (function() {
            const CURRENT_VERSION = '123';
            const CHECK_INTERVAL = 8000; // Chequear cada 8 segundos
            let isChecking = false;

            async function checkVersion() {
                if (isChecking) return;
                // No recargar automáticamente si el usuario está en modo de edición visual
                if (typeof ES_MODO_EDICION !== 'undefined' && ES_MODO_EDICION) return;

                isChecking = true;
                try {
                    const res = await fetch('version.php?t=' + Date.now(), { 
                        cache: 'no-store',
                        headers: { 'Cache-Control': 'no-cache', 'Pragma': 'no-cache' }
                    });
                    if (res.ok) {
                        const data = await res.json();
                        if (data && data.version && data.version !== CURRENT_VERSION) {
                            console.log('🔄 Nueva versión detectada en producción (' + data.version + '). Actualizando en tiempo real...');
                            window.location.reload();
                        }
                    }
                } catch (e) {
                    // Manejo silencioso en caso de micro-cortes de red
                } finally {
                    isChecking = false;
                }
            }

            // Chequeo periódico en segundo plano
            setInterval(checkVersion, CHECK_INTERVAL);

            // Chequeo instantáneo cuando el usuario vuelve a enfocar la pestaña
            document.addEventListener('visibilitychange', function() {
                if (document.visibilityState === 'visible') {
                    checkVersion();
                }
            });
            window.addEventListener('focus', checkVersion);
        })();

    