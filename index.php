<?php
header('Content-Type: text/html; charset=UTF-8');
require_once __DIR__ . '/config.php';
$landing_slug  = 'dji-osmo-pocket-3';
$nombre_marca  = 'DJI';
$landing_token = obtenerOCrearTokenLanding($landing_slug, "DJI Osmo Pocket 3 Creator Combo | Cámara Gimbal 4K 120fps Sensor 1\"", 1850000);
$precio_num    = 1850000;
$precio_fmt    = '1.850.000';
$es_modo_edicion = isset($_GET['modo_edicion']) && $_GET['modo_edicion'] == '1';

// ─── Cargar Productos de Otras Landings con Rutas Relativas Correctas ───
$otros_productos = [];
try {
    if (isset($pdo)) {
        $stmt = $pdo->prepare("SELECT slug, producto, precio, imagenes FROM landings WHERE slug != ? ORDER BY id DESC LIMIT 12");
        $stmt->execute([$landing_slug]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $r) {
            $other_slug = $r['slug'];
            $imgs = is_array($r['imagenes']) ? $r['imagenes'] : (json_decode($r['imagenes'] ?? '{}', true) ?: []);
            $raw_img = $imgs['img_1'] ?? ($imgs['producto'] ?? ($imgs['desktop'] ?? 'img/img_1.webp'));
            
            $final_img = (strpos($raw_img, 'http') === 0) ? $raw_img : "../{$other_slug}/" . ltrim($raw_img, '/');
            $otros_productos[] = [
                'slug'   => $other_slug,
                'nombre' => $r['producto'],
                'precio' => '$ ' . number_format($r['precio'], 0, ',', '.'),
                'url'    => "../{$other_slug}/",
                'img'    => $final_img
            ];
            if (count($otros_productos) >= 6) break;
        }
    }
} catch (Exception $e) {}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?= htmlspecialchars("DJI Osmo Pocket 3 Creator Combo | Cámara Gimbal 4K 120fps Sensor 1\"") ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    
    <style>
        @font-face {
            font-family: '__MiddleEast_309aa8';
            src: local('Montserrat'), local('Inter'), local('Segoe UI');
        }

        :root {
            --primary: #111111;
            --accent: #e85d75;
            --btn-bg: #111111;
            --topbar-bg: #000000;
            --body-bg: #ffffff;
            --text-main: #111111;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --star-color: #f59e0b;
            --font-heading: '__MiddleEast_309aa8', 'Montserrat', sans-serif;
            --font-body: '__MiddleEast_309aa8', 'Inter', sans-serif;
        }

                /* ─── RESET Y CONTROL ESTRICTO DE OVERFLOW HORIZONTAL ─── */
        *, *::before, *::after {
            box-sizing: border-box !important;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            max-width: 100% !important;
            overflow-x: hidden !important;
            position: relative;
            font-family: var(--font-body);
            background-color: var(--body-bg);
            color: var(--text-main);
            line-height: 1.4;
            -webkit-font-smoothing: antialiased;
        }

        @media (max-width: 991px) {
            body { padding-bottom: 85px; }
        }

        /* ─── TOPBAR TICKER INFINITO EN MOVIMIENTO CONTINUO ─── */
        .top-announcement {
            background-color: var(--topbar-bg, #000000);
            color: #ffffff;
            font-family: var(--font-heading);
            font-size: 10px;
            font-weight: 700;
            padding: 4.5px 0;
            line-height: 1.2;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            overflow: hidden !important;
            white-space: nowrap;
            position: relative;
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box;
            display: flex;
            align-items: center;
        }
        .topbar-marquee-track {
            display: flex;
            width: max-content;
            animation: topbarMarqueeScroll 35s linear infinite;
            will-change: transform;
        }
        .topbar-marquee-track:hover {
            animation-play-state: paused;
        }
        .marquee-content {
            display: flex;
            flex-shrink: 0;
            align-items: center;
        }
        .marquee-content span {
            padding: 0 18px;
            display: inline-block;
        }
        @keyframes topbarMarqueeScroll {
            0% { transform: translate3d(0, 0, 0); }
            100% { transform: translate3d(-50%, 0, 0); }
        }

        /* ─── NAVBAR CON LOGO CENTRADO ─── */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 18px;
            background-color: #ffffff;
            border-bottom: 1px solid #f3f4f6;
            position: sticky;
            top: 0;
            z-index: 100;
            min-height: 74px;
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box;
        }
        .nav-left { width: 44px; flex-shrink: 0; }
        .nav-center-logo { flex: 1; display: flex; justify-content: center; align-items: center; text-align: center; }
        .brand-logo-img { height: 58px; max-height: 62px; max-width: 220px; width: auto; object-fit: contain; transition: transform 0.2s ease; display: block; margin: 0 auto; }
        .brand-logo-img:hover { transform: scale(1.03); }
        .brand-logo-text { font-family: var(--font-heading); font-size: 28px; font-weight: 900; letter-spacing: 3px; color: #111111; text-transform: uppercase; text-decoration: none; display: inline-block; }
        .nav-right { width: 44px; display: flex; justify-content: flex-end; align-items: center; flex-shrink: 0; }
        .cart-trigger { position: relative; background: none; border: none; cursor: pointer; color: #111827; padding: 6px; }
        .cart-badge-count { position: absolute; top: -2px; right: -4px; background-color: var(--primary); color: #ffffff; font-size: 10px; font-weight: 800; width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid #ffffff; }@media (min-width: 768px) {
            .navbar { padding: 12px 28px; min-height: 86px; }
            .brand-logo-img { height: 72px; max-height: 76px; max-width: 300px; }
            .brand-logo-text { font-size: 34px; letter-spacing: 3.5px; }
        }

        .landing-container {
            max-width: 1280px;
            width: 100% !important;
            margin: 0 auto;
            padding: 16px 14px 26px 14px;
            box-sizing: border-box;
            overflow-x: hidden;
        }
        @media (min-width: 768px) {
            .landing-container { padding: 20px 20px 30px 20px; }
        }

        .product-grid-layout {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 100%;
            box-sizing: border-box;
        }

        /* ─── GALLERY SECTION ─── */
        .gallery-wrapper-desktop {
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 100%;
            box-sizing: border-box;
        }
        .main-image-wrap {
            order: 1;
            width: 100%;
            aspect-ratio: 1 / 1;
            background-color: #fafafa;
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            cursor: pointer;
            box-sizing: border-box;
            touch-action: pan-y pinch-zoom;
        }
        .main-image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.25s ease, transform 0.3s ease;
            user-select: none;
            -webkit-user-drag: none;
        }
        
        /* ─── FLECHAS DE GALERÍA: TRANSLÚCIDO GRISÁCEO EN VISTA NORMAL ─── */
        .gallery-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 38px;
            height: 38px;
            background: rgba(30, 30, 30, 0.4) !important;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            border-radius: 50%;
            display: flex !important;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            color: #ffffff !important;
            font-size: 16px;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
            outline: none;
            opacity: 1 !important;
            visibility: visible !important;
            transition: transform 0.15s ease;
        }
        .gallery-arrow:active {
            transform: translateY(-50%) scale(0.92);
        }
        .gallery-arrow.prev { left: 10px; }
        .gallery-arrow.next { right: 10px; }

        /* ─── BOTONES DE MODO VISUALIZACIÓN (LIGHTBOX): BLANCOS SÓLIDOS ─── */
        .lightbox-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 48px;
            height: 48px;
            background: #ffffff !important;
            border: none !important;
            border-radius: 50%;
            color: #111111 !important;
            font-size: 22px;
            font-weight: 800;
            cursor: pointer;
            display: flex !important;
            align-items: center;
            justify-content: center;
            z-index: 20;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5) !important;
            opacity: 1 !important;
            visibility: visible !important;
            transition: transform 0.15s ease;
        }
        .lightbox-nav-btn:active {
            transform: translateY(-50%) scale(0.92);
        }
        .lightbox-nav-btn.prev { left: 14px; }
        .lightbox-nav-btn.next { right: 14px; }
        @media (min-width: 992px) {
            .lightbox-nav-btn.prev { left: 30px; }
            .lightbox-nav-btn.next { right: 30px; }
        }

        @media (min-width: 1025px) and (hover: hover) {
            .main-image-wrap:hover img {
                transform: scale(1.04);
            }
        }
        @media (max-width: 1024px) {
            .main-image-wrap {
                cursor: pointer;
            }
            .main-image-wrap img {
                transform: none !important;
            }
        }

        .thumbnails-strip { order: 2; display: flex; gap: 10px; overflow-x: auto; padding-bottom: 6px; scrollbar-width: none; -webkit-overflow-scrolling: touch; }
        .thumbnails-strip::-webkit-scrollbar { display: none; }
        .thumb-item { flex: 0 0 70px; height: 70px; border-radius: 10px; overflow: hidden; border: 2px solid var(--border-color); cursor: pointer; transition: all 0.2s ease; background: #f9fafb; }
        .thumb-item.active { border-color: var(--primary); box-shadow: 0 0 0 1px var(--primary); }
        .thumb-item img { width: 100%; height: 100%; object-fit: cover; }

        .product-info { padding: 0 4px; }
        .product-title { font-family: var(--font-heading); font-size: 21px; font-weight: 800; color: #111111; line-height: 1.35; margin-bottom: 8px; }
        .rating-row { display: flex; align-items: center; gap: 6px; margin-bottom: 14px; }
        .stars-container { display: flex; color: var(--star-color); font-size: 15px; }
        .rating-number { font-size: 13px; font-weight: 700; color: #374151; }
        .reviews-count { font-size: 13px; color: var(--text-muted); }

        .price-row { display: flex; align-items: baseline; gap: 10px; margin-bottom: 20px; }
        .current-price { font-family: var(--font-heading); font-size: 28px; font-weight: 900; color: #111111; }
        .old-price { font-size: 16px; color: #9ca3af; text-decoration: line-through; font-weight: 600; }
        .discount-pill { background-color: #fee2e2; color: #ef4444; font-size: 11px; font-weight: 800; padding: 3px 8px; border-radius: 6px; }

        .variant-block { margin-bottom: 18px; border-top: 1px solid #f3f4f6; padding-top: 14px; }
        .variant-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; font-size: 13px; }
        .variant-label { font-weight: 700; color: #111111; }
        .variant-label span { font-weight: 500; color: #4b5563; }
        .swatches-row { display: flex; gap: 12px; align-items: center; }
        .swatch-circle { width: 34px; height: 34px; border-radius: 50%; cursor: pointer; position: relative; border: 2px solid transparent; box-shadow: inset 0 0 0 1px rgba(0,0,0,0.15); transition: all 0.2s ease; }
        .swatch-circle.active { border-color: #111111; transform: scale(1.1); }

        .size-block { margin-bottom: 22px; }
        .size-pills-row { display: flex; gap: 10px; }
        .size-pill { padding: 9px 20px; border-radius: 8px; font-size: 13px; font-weight: 700; background: #111111; color: #ffffff; border: none; cursor: pointer; }

        .desktop-action-row { display: none; gap: 14px; align-items: center; margin-bottom: 24px; }
        .qty-controls-desktop { display: flex; align-items: center; border: 1px solid var(--border-color); border-radius: 10px; overflow: hidden; height: 50px; background: #ffffff; }
        .qty-btn-desktop { background: #f9fafb; border: none; width: 42px; height: 100%; font-size: 18px; font-weight: 700; cursor: pointer; color: #374151; display: flex; align-items: center; justify-content: center; transition: background 0.2s; }
        .qty-btn-desktop:hover { background: #f3f4f6; }
        .qty-val-desktop { width: 44px; text-align: center; font-size: 15px; font-weight: 700; }
        .btn-add-desktop { flex: 1; height: 50px; background-color: var(--btn-bg); color: #ffffff; border: none; border-radius: 10px; font-family: var(--font-heading); font-size: 14px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; cursor: pointer; transition: all 0.2s ease; }
        .btn-add-desktop:hover { opacity: 0.92; transform: translateY(-1px); box-shadow: 0 6px 18px rgba(0,0,0,0.18); }

        .accordion-item { border-bottom: 1px solid var(--border-color); }
        .accordion-header { width: 100%; display: flex; justify-content: space-between; align-items: center; padding: 14px 0; background: none; border: none; font-family: var(--font-heading); font-size: 14px; font-weight: 700; color: #111111; cursor: pointer; text-align: left; }
        .accordion-body { display: none; padding-bottom: 14px; font-size: 13px; color: #4b5563; line-height: 1.6; }
        .accordion-body.open { display: block; }

        .secure-trust-box { background: #f0fdf4; border: 1px solid #dcfce7; border-radius: 10px; padding: 14px 18px; margin-top: 22px; }
        .secure-trust-header { display: flex; align-items: center; gap: 8px; font-family: var(--font-heading); font-size: 14px; font-weight: 800; color: #111111; margin-bottom: 10px; }
        .secure-trust-header svg { flex-shrink: 0; }
        .secure-trust-list { list-style: none; display: flex; flex-direction: column; gap: 6px; }
        .secure-trust-list li { display: flex; align-items: flex-start; gap: 8px; font-size: 12.5px; color: #374151; line-height: 1.45; }
        .secure-trust-list .check-icon { color: #10b981; font-weight: 900; font-size: 13px; line-height: 1.3; }

        /* ─── BANNER MERCADOLIBRE ─── */
        .ml-promo-banner-wrap { max-width: 1280px; width: 100%; margin: 25px auto 10px auto; padding: 0 14px; box-sizing: border-box; cursor: pointer; overflow-x: hidden; }
        .ml-banner-inner { background: #ffe600; border-radius: 50px; padding: 8px 24px; display: flex; align-items: center; justify-content: space-between; gap: 16px; box-shadow: 0 4px 15px rgba(255, 230, 0, 0.35); transition: transform 0.2s, box-shadow 0.2s; overflow: hidden; }
        .ml-banner-inner:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(255, 230, 0, 0.5); }
        .ml-banner-left { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }
        .ml-logo-img { height: 38px; max-width: 140px; object-fit: contain; }
        .ml-banner-divider { width: 1px; height: 28px; background: rgba(0, 0, 0, 0.15); flex-shrink: 0; }
        .ml-banner-center { flex: 1; display: flex; align-items: center; gap: 10px; overflow: hidden; white-space: nowrap; }
        .ml-brand-name { font-family: var(--font-heading); font-weight: 900; font-size: 15px; color: #111111; letter-spacing: 1px; text-transform: uppercase; }
        .ml-product-name { font-family: var(--font-heading); font-weight: 800; font-size: 14px; color: #111111; text-transform: uppercase; overflow: hidden; text-overflow: ellipsis; }
        .ml-stripes { color: #d97706; font-weight: 900; font-size: 16px; letter-spacing: -2px; display: flex; }
        .ml-banner-right { flex-shrink: 0; }
        .ml-free-shipping-pill { display: flex; align-items: center; border-radius: 20px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.15); font-family: var(--font-heading); font-size: 11px; font-weight: 800; }
        .pill-dark { background: #0a1945; color: #ffffff; padding: 8px 14px; display: flex; align-items: center; gap: 4px; }
        .pill-white { background: #ffffff; color: #0a1945; padding: 8px 12px; }

        @media (max-width: 768px) {
            .ml-banner-inner { border-radius: 16px; padding: 10px 14px; flex-wrap: wrap; gap: 8px; }
            .ml-banner-divider { display: none; }
            .ml-free-shipping-pill { font-size: 10px; }
            .pill-dark, .pill-white { padding: 6px 10px; }
        }

        /* ─── CUSTOMER REVIEWS SECTION ─── */
        .customer-reviews-section { max-width: 1280px; width: 100%; margin: 40px auto 30px auto; padding: 0 14px; box-sizing: border-box; overflow-x: hidden; font-family: var(--font-body); }
        .reviews-header-block { text-align: center; margin-bottom: 20px; }
        .reviews-main-title { font-family: var(--font-heading); font-size: 26px; font-weight: 900; color: #111111; margin-bottom: 8px; letter-spacing: -0.5px; }
        .overall-rating-wrap { display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 24px; }
        .overall-rating-num { font-size: 24px; font-weight: 900; color: #111111; }
        .overall-stars-gold { color: #f59e0b; font-size: 20px; letter-spacing: 2px; }
        .reviews-filters-row { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; padding-bottom: 16px; border-bottom: 1px solid #f3f4f6; margin-bottom: 10px; }
        .filters-left-group { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
        .filters-right-group { display: flex; align-items: center; gap: 8px; }
        .review-filter-pill { display: inline-flex; align-items: center; gap: 6px; font-size: 12px; color: #374151; font-weight: 600; }
        .filter-select-box { border: 1px solid #d1d5db; border-radius: 6px; padding: 6px 24px 6px 10px; font-size: 12px; color: #111111; background: #ffffff; appearance: none; cursor: pointer; font-weight: 500; }
        .review-card-item { display: grid; grid-template-columns: 220px 1fr auto; gap: 20px; padding: 22px 0; border-bottom: 1px solid #f3f4f6; align-items: start; }
        @media (max-width: 768px) { .review-card-item { grid-template-columns: 1fr; gap: 8px; } }
        .reviewer-col { display: flex; border-right: none; flex-direction: column; gap: 3px; }
        .reviewer-name { font-weight: 800; font-size: 13.5px; color: #111111; }
        .reviewer-meta { font-size: 11.5px; color: #6b7280; }
        .review-content-col { display: flex; flex-direction: column; gap: 6px; }
        .review-stars-row { color: #f59e0b; font-size: 14px; letter-spacing: 1px; }
        .review-comment-text { font-size: 13px; color: #1f2937; line-height: 1.5; font-weight: 600; }
        .review-date-badge { font-size: 11px; color: #9ca3af; white-space: nowrap; text-align: right; }
        @media (max-width: 768px) { .review-date-badge { text-align: left; } }
        .reviews-pagination-row { display: flex; justify-content: flex-end; align-items: center; gap: 8px; margin-top: 24px; font-size: 12px; color: #6b7280; }
        .page-btn { width: 28px; height: 28px; border: 1px solid transparent; background: transparent; border-radius: 50%; cursor: pointer; font-size: 12px; font-weight: 700; color: #374151; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s; }
        .page-btn.active { background: #111111; color: #ffffff; }
        .page-btn:hover:not(.active) { background: #f3f4f6; }

        /* ─── MÁS PRODUCTOS RECOMENDADOS (CRUZADOS) ─── */
        .more-to-love-section { max-width: 1280px; width: 100%; margin: 30px auto 40px auto; padding: 0 14px; box-sizing: border-box; text-align: center; overflow-x: hidden; }
        .section-heading-center { font-family: var(--font-heading); font-size: 22px; font-weight: 900; letter-spacing: 1px; color: #111111; margin-bottom: 18px; text-transform: uppercase; }
        .more-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); gap: 16px; }
        .more-card { background: #ffffff; border: 1px solid #f3f4f6; border-radius: 12px; overflow: hidden; padding: 10px; text-align: left; text-decoration: none; display: flex; flex-direction: column; transition: all 0.2s ease; }
        .more-card:hover { box-shadow: 0 8px 20px rgba(0,0,0,0.06); transform: translateY(-2px); border-color: var(--accent); }
        .more-card-img { width: 100%; aspect-ratio: 1/1; border-radius: 8px; object-fit: cover; background: #fafafa; }
        .more-card-title { font-size: 13px; font-weight: 700; color: #111111; margin: 8px 0 4px 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .more-card-stars { font-size: 12px; color: var(--star-color); margin-bottom: 4px; }
        .more-card-price { font-weight: 900; font-size: 14px; color: #111111; margin-top: auto; }

        /* ─── 7. FOOTER MODERNO (ESTILO SHEGLAM / AMAZON) ─── */
        .generic-footer {
            background: #000000;
            color: #ffffff;
            padding: 38px 20px 32px 20px;
            margin-top: 45px;
            width: 100%;
            box-sizing: border-box;
            overflow-x: hidden;
        }
        .footer-content-wrap {
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 20px;
            position: relative;
        }
        .footer-payments-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .payment-badge-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            border-radius: 6px;
            padding: 4px 8px;
            height: 28px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
            transition: transform 0.2s ease;
            box-sizing: border-box;
        }
        .payment-badge-pill:hover {
            transform: translateY(-2px);
        }
        .payment-svg-img {
            max-height: 20px;
            height: auto;
            width: auto;
            max-width: 65px;
            object-fit: contain;
            display: block;
        }
        .footer-legal-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 600;
            color: #e5e7eb;
            flex-wrap: wrap;
            letter-spacing: 0.2px;
        }
        .footer-flag-icon {
            font-size: 16px;
        }
        .footer-legal-text {
            color: #e5e7eb;
            text-decoration: underline;
            text-underline-offset: 3px;
            transition: color 0.2s ease;
        }
        .footer-legal-text:hover {
            color: #ffffff;
        }
        .footer-legal-divider {
            color: #6b7280;
            font-size: 10px;
        }
        .footer-bottom-row {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-top: 4px;
        }
        .footer-copyright-text {
            font-size: 12px;
            color: #9ca3af;
            font-weight: 500;
            letter-spacing: 0.3px;
        }
        .btn-scroll-top {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #ffffff;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.4);
        }
        .btn-scroll-top:hover {
            background: #ffffff;
            color: #000000;
            transform: translateY(-50%) scale(1.1);
        }
        @media (max-width: 640px) {
            .footer-legal-row {
                font-size: 12px;
                gap: 6px;
            }
            .footer-bottom-row {
                flex-direction: column;
                gap: 14px;
            }
            .btn-scroll-top {
                position: static;
                transform: none;
            }
            .btn-scroll-top:hover {
                transform: scale(1.1);
            }
        }
        .footer-flag-icon {
            font-size: 16px;
        }
        .footer-legal-text {
            color: #e5e7eb;
            text-decoration: underline;
            text-underline-offset: 3px;
            transition: color 0.2s ease;
        }
        .footer-legal-text:hover {
            color: #ffffff;
        }
        .footer-legal-divider {
            color: #6b7280;
            font-size: 10px;
        }
        .footer-bottom-row {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-top: 4px;
        }
        .footer-copyright-text {
            font-size: 12px;
            color: #9ca3af;
            font-weight: 500;
            letter-spacing: 0.3px;
        }
        .btn-scroll-top {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #ffffff;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.4);
        }
        .btn-scroll-top:hover {
            background: #ffffff;
            color: #000000;
            transform: translateY(-50%) scale(1.1);
        }
        @media (max-width: 640px) {
            .footer-legal-row {
                font-size: 12px;
                gap: 6px;
            }
            .footer-bottom-row {
                flex-direction: column;
                gap: 14px;
            }
            .btn-scroll-top {
                position: static;
                transform: none;
            }
            .btn-scroll-top:hover {
                transform: scale(1.1);
            }
        }

        .sticky-footer-bar { position: fixed; bottom: 0; left: 0; right: 0; background: #ffffff; border-top: 1px solid var(--border-color); padding: 10px 16px 14px 16px; display: flex; align-items: center; gap: 12px; z-index: 900; box-shadow: 0 -4px 15px rgba(0,0,0,0.06); max-width: 540px; margin: 0 auto; }
        .support-btn { width: 46px; height: 46px; border-radius: 10px; border: 1px solid var(--border-color); background: #ffffff; display: flex; align-items: center; justify-content: center; color: #111111; text-decoration: none; flex-shrink: 0; }
        .btn-add-to-cart { flex: 1; height: 48px; background-color: var(--btn-bg); color: #ffffff; border: none; border-radius: 12px; font-family: var(--font-heading); font-size: 14px; font-weight: 800; display: flex; align-items: center; justify-content: center; gap: 6px; cursor: pointer; letter-spacing: 0.5px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); }

        @media (min-width: 992px) {
            .product-grid-layout { display: grid; grid-template-columns: 1.15fr 1fr; gap: 50px; align-items: start; }
            .gallery-wrapper-desktop { flex-direction: row; gap: 16px; }
            .thumbnails-strip { order: 1; flex-direction: column; width: 76px; max-height: 520px; overflow-y: auto; overflow-x: hidden; padding-bottom: 0; }
            .thumb-item { flex: 0 0 74px; height: 74px; }
            .main-image-wrap { order: 2; flex: 1; max-width: 520px; }
            .desktop-action-row { display: flex; }
            .sticky-footer-bar { display: none !important; }
            .more-grid { grid-template-columns: repeat(6, 1fr); }
        }

        .lightbox-modal { position: fixed; inset: 0; background: rgba(0, 0, 0, 0.94); z-index: 99999; display: none; align-items: center; justify-content: center; flex-direction: column; backdrop-filter: blur(5px); }
        .lightbox-modal.open { display: flex; }
        .lightbox-close-btn { position: absolute; top: 20px; right: 24px; background: rgba(255, 255, 255, 0.15); border: none; color: #ffffff; width: 44px; height: 44px; border-radius: 50%; font-size: 24px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s; z-index: 100; }
        .lightbox-main-view { max-width: 90vw; max-height: 78vh; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; }
        .lightbox-main-view img { max-width: 100%; max-height: 78vh; object-fit: contain; border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.5); cursor: zoom-in; transition: transform 0.22s ease-out; }
        .lightbox-main-view img.zoomed { transform: scale(2.2); cursor: zoom-out; }
        
        .lightbox-nav-btn.prev { left: -70px; }
        .lightbox-nav-btn.next { right: -70px; }
        @media (max-width: 768px) { .lightbox-nav-btn.prev { left: 10px; } .lightbox-nav-btn.next { right: 10px; } }
        .lightbox-thumbs-row { display: flex; gap: 10px; margin-top: 20px; max-width: 90vw; overflow-x: auto; padding: 8px; }
        .lightbox-thumb { width: 54px; height: 54px; border-radius: 6px; overflow: hidden; border: 2px solid transparent; cursor: pointer; opacity: 0.6; transition: all 0.2s; }
        .lightbox-thumb.active { border-color: #ffffff; opacity: 1; transform: scale(1.1); }
        .lightbox-thumb img { width: 100%; height: 100%; object-fit: cover; }

        .cart-overlay { position: fixed; inset: 0; background: rgba(0, 0, 0, 0.6); z-index: 10000; opacity: 0; visibility: hidden; transition: all 0.3s ease; backdrop-filter: blur(2px); }
        .cart-overlay.open { opacity: 1; visibility: visible; }
        .cart-drawer { position: fixed; top: 0; right: -100%; bottom: 0; width: 100%; max-width: 420px; background: #ffffff; z-index: 10001; transition: right 0.35s cubic-bezier(0.16, 1, 0.3, 1); display: flex; flex-direction: column; box-shadow: -5px 0 25px rgba(0,0,0,0.2); }
        .cart-overlay.open .cart-drawer { right: 0; }
        .cart-header { display: flex; align-items: center; justify-content: space-between; padding: 18px 20px; border-bottom: 1px solid var(--border-color); }
        .cart-header h3 { font-family: var(--font-heading); font-size: 16px; font-weight: 800; color: #111111; }
        .close-cart-btn { background: none; border: none; font-size: 22px; cursor: pointer; color: #6b7280; display: flex; align-items: center; justify-content: center; padding: 4px; }
        .shipping-progress-wrap { background: #f9fafb; padding: 12px 20px; border-bottom: 1px solid #f3f4f6; }
        .shipping-progress-text { font-size: 12px; font-weight: 700; color: #059669; margin-bottom: 6px; display: flex; align-items: center; gap: 6px; }
        .shipping-bar { height: 6px; background: #e5e7eb; border-radius: 3px; overflow: hidden; }
        .shipping-bar-fill { height: 100%; background: #059669; width: 100%; border-radius: 3px; }
        .cart-items-list { flex: 1; overflow-y: auto; padding: 16px 20px; }
        .cart-item { display: flex; gap: 14px; padding-bottom: 16px; border-bottom: 1px solid #f3f4f6; margin-bottom: 16px; }
        .cart-item-img { width: 72px; height: 72px; border-radius: 8px; object-fit: cover; background: #f3f4f6; }
        .cart-item-info { flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .cart-item-title { font-size: 13px; font-weight: 700; color: #111111; line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .cart-item-variant { font-size: 11px; color: var(--text-muted); margin-top: 2px; }
        .cart-item-bottom { display: flex; justify-content: space-between; align-items: center; margin-top: 8px; }
        .cart-item-price { font-weight: 800; font-size: 14px; color: #111111; }
        .qty-controls { display: flex; align-items: center; border: 1px solid var(--border-color); border-radius: 6px; overflow: hidden; }
        .qty-btn { background: #f9fafb; border: none; width: 26px; height: 26px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #374151; }
        .qty-value { width: 28px; text-align: center; font-size: 12px; font-weight: 700; }
        .cart-footer { padding: 20px; background: #ffffff; border-top: 1px solid var(--border-color); box-shadow: 0 -4px 15px rgba(0,0,0,0.05); }
        .cart-summary-row { display: flex; justify-content: space-between; font-size: 13px; color: #4b5563; margin-bottom: 8px; }
        .cart-summary-row.total { font-family: var(--font-heading); font-size: 17px; font-weight: 900; color: #111111; margin-top: 8px; padding-top: 8px; border-top: 1px dashed var(--border-color); }
        .btn-checkout { width: 100%; height: 50px; background-color: var(--btn-bg); color: #ffffff; border: none; border-radius: 12px; font-family: var(--font-heading); font-size: 15px; font-weight: 800; cursor: pointer; margin-top: 14px; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.2s ease; }

        .editor-top-toolbar { position: fixed; top: 0; left: 0; right: 0; background: #0f172a; color: #ffffff; padding: 10px 20px; display: flex; align-items: center; justify-content: space-between; z-index: 999999; box-shadow: 0 4px 20px rgba(0,0,0,0.4); font-family: 'Inter', sans-serif; font-size: 13px; }
        .editor-badge { background: #22c55e; color: #000; font-weight: 800; font-size: 11px; padding: 4px 10px; border-radius: 20px; text-transform: uppercase; }
        .editor-actions { display: flex; gap: 10px; align-items: center; }
        .btn-editor-save { background: #3b82f6; color: #ffffff; border: none; padding: 8px 18px; border-radius: 8px; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 6px; }
        .btn-editor-preview { background: rgba(255,255,255,0.15); color: #ffffff; border: 1px solid rgba(255,255,255,0.2); padding: 8px 16px; border-radius: 8px; font-weight: 600; text-decoration: none; }

        body.modo-edicion-activo [data-editable="true"]:hover { outline: 2px dashed #3b82f6 !important; cursor: text; background: rgba(59, 130, 246, 0.05); }
        body.modo-edicion-activo [data-editable="true"]:focus { outline: 2px solid #22c55e !important; background: rgba(34, 197, 94, 0.08); }

        #landing-loader { display: none; position: fixed; inset: 0; background: rgba(255, 255, 255, 0.95); z-index: 99999; flex-direction: column; justify-content: center; align-items: center; }
        .spinner { width: 44px; height: 44px; border: 3px solid #f3f4f6; border-top-color: var(--primary); border-radius: 50%; animation: spin 0.8s linear infinite; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    
        

    
        
        /* ─── ANIMACIONES PROFESIONALES DEL CARRITO Y LOTTIE ─── */
        .cart-trigger {
            position: relative;
            background: none;
            border: none;
            cursor: pointer;
            color: #111827;
            padding: 6px;
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .cart-pop-active {
            animation: cartPopBounce 0.45s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
        }
        @keyframes cartPopBounce {
            0% { transform: scale(1); }
            35% { transform: scale(1.4); }
            70% { transform: scale(0.92); }
            100% { transform: scale(1); }
        }
        .cart-ripple-effect {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 46px;
            height: 46px;
            margin-left: -23px;
            margin-top: -23px;
            border-radius: 50%;
            border: 2.5px solid var(--primary, #111111);
            pointer-events: none;
            animation: cartRippleAnim 0.65s cubic-bezier(0.1, 0.8, 0.3, 1) forwards;
        }
        @keyframes cartRippleAnim {
            0% { transform: scale(0.4); opacity: 0.95; }
            100% { transform: scale(1.85); opacity: 0; }
        }
        .cart-badge-bounce {
            animation: cartBadgeBounce 0.45s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        @keyframes cartBadgeBounce {
            0% { transform: scale(1); }
            45% { transform: scale(1.5); }
            100% { transform: scale(1); }
        }

        /* ─── 5.2 REVIEWS WITH VIDEOS CAROUSEL (AMAZON STYLE) ─── */
        .video-reviews-section {
            max-width: 1200px;
            margin: 28px auto 14px auto;
            padding: 0 16px;
            box-sizing: border-box;
        }
        .video-reviews-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 14px;
            gap: 12px;
            flex-wrap: wrap;
        }
        .video-reviews-title-wrap {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }
        .video-reviews-main-title {
            font-family: var(--font-heading, 'Montserrat', sans-serif);
            font-size: 20px;
            font-weight: 800;
            color: #111827;
            margin: 0;
            letter-spacing: -0.3px;
        }
        .video-reviews-subtitle {
            font-size: 13px;
            color: var(--text-muted, #6b7280);
            font-weight: 500;
        }
        .video-reviews-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn-add-video-card {
            background: #22c55e;
            color: #ffffff;
            border: none;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(34, 197, 94, 0.35);
            transition: transform 0.2s ease, background 0.2s ease;
        }
        .btn-add-video-card:hover {
            background: #16a34a;
            transform: scale(1.03);
        }
        .video-carousel-arrows {
            display: flex;
            gap: 6px;
        }
        .video-arrow-btn {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            color: #1f2937;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
            transition: all 0.2s ease;
        }
        .video-arrow-btn:hover {
            background: #111827;
            color: #ffffff;
            border-color: #111827;
        }

        .video-reviews-carousel-track {
            display: flex;
            gap: 14px;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            padding: 8px 4px 18px 4px;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }
        .video-reviews-carousel-track::-webkit-scrollbar {
            height: 6px;
        }
        .video-reviews-carousel-track::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 6px;
        }

        .video-review-card {
            flex: 0 0 160px;
            height: 250px;
            border-radius: 14px;
            position: relative;
            overflow: hidden;
            background: #000000;
            cursor: pointer;
            scroll-snap-align: start;
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
            transition: transform 0.25s cubic-bezier(0.2, 0.8, 0.2, 1), box-shadow 0.25s ease;
            user-select: none;
        }
        @media (max-width: 640px) {
            .video-review-card {
                flex: 0 0 140px;
                height: 220px;
                border-radius: 12px;
            }
        }
        .video-review-card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 10px 22px rgba(0,0,0,0.25);
        }
        .video-card-thumb {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
            background: #1e293b;
        }
        .video-review-card:hover .video-card-thumb {
            transform: scale(1.06);
        }
        .video-card-gradient {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.92) 0%, rgba(0,0,0,0.5) 45%, rgba(0,0,0,0.05) 80%, transparent 100%);
            pointer-events: none;
        }
        .video-card-badge-play {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0,0,0,0.65);
            backdrop-filter: blur(4px);
            color: #ffffff;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            padding-left: 2px;
            border: 1px solid rgba(255,255,255,0.3);
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
            transition: all 0.2s ease;
            z-index: 2;
        }
        .video-review-card:hover .video-card-badge-play {
            background: #e11d48;
            border-color: #e11d48;
            transform: scale(1.15);
        }
        .video-card-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 12px 10px;
            color: #ffffff;
            z-index: 2;
            pointer-events: none;
        }
        .video-card-stars {
            color: #f97316;
            font-size: 13px;
            letter-spacing: 1.5px;
            margin-bottom: 3px;
            text-shadow: 0 1px 3px rgba(0,0,0,0.8);
        }
        .video-card-duration {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 800;
            font-family: var(--font-heading, sans-serif);
            color: #ffffff;
            text-shadow: 0 1px 4px rgba(0,0,0,0.9);
        }
        .play-icon-mini {
            font-size: 10px;
            opacity: 0.9;
        }
        .video-card-title-text {
            font-size: 11px;
            font-weight: 600;
            color: #e2e8f0;
            margin-top: 3px;
            line-height: 1.25;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-shadow: 0 1px 3px rgba(0,0,0,0.9);
        }

        .video-card-admin-bar {
            position: absolute;
            top: 8px;
            left: 8px;
            display: flex;
            gap: 4px;
            z-index: 15;
        }
        .btn-vcard-edit {
            background: #3b82f6;
            color: #ffffff;
            border: none;
            font-size: 10px;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 6px;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        }
        .btn-vcard-del {
            background: #ef4444;
            color: #ffffff;
            border: none;
            font-size: 10px;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 6px;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        }

        /* ─── VIDEO LIGHTBOX MODAL ─── */
        .video-modal-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.88);
            backdrop-filter: blur(8px);
            z-index: 9999999;
            justify-content: center;
            align-items: center;
            padding: 16px;
            box-sizing: border-box;
            opacity: 0;
            transition: opacity 0.25s ease;
        }
        .video-modal-backdrop.active {
            display: flex;
            opacity: 1;
        }
        .video-modal-container {
            position: relative;
            width: 100%;
            max-width: 820px;
            background: #000000;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.15);
            transform: scale(0.94);
            transition: transform 0.25s cubic-bezier(0.2, 0.8, 0.2, 1);
        }
        .video-modal-backdrop.active .video-modal-container {
            transform: scale(1);
        }
        .video-modal-close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 20;
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.35);
            color: #ffffff;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        .video-modal-close-btn:hover {
            background: #ef4444;
            border-color: #ef4444;
            transform: scale(1.1);
        }
        .video-modal-iframe-wrapper {
            position: relative;
            width: 100%;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
            background: #000000;
        }
        .video-modal-iframe-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
</head>
<body class="<?= $es_modo_edicion ? 'modo-edicion-activo' : '' ?>" style="<?= $es_modo_edicion ? 'margin-top: 50px;' : '' ?>">

    <?php if ($es_modo_edicion): ?>
    <div class="editor-top-toolbar" id="editorToolbar">
        <div style="display:flex; align-items:center; gap:12px;">
            <span class="editor-badge">🎨 Modo Edición Activo</span>
            <span style="color:#94a3b8; font-size:12px;">💡 Haz <b>doble clic</b> en cualquier texto para modificarlo en vivo.</span>
        </div>
        <div class="editor-actions">
            <button class="btn-editor-save" onclick="guardarCambiosVisuales()">💾 Guardar Cambios</button>
            <a href="?" class="btn-editor-preview">👁️ Ver como Cliente</a>
        </div>
    </div>
    <?php endif; ?>

    <div id="landing-loader">
        <div class="spinner"></div>
        <p style="margin-top: 14px; font-family: var(--font-heading); font-weight: 700; font-size: 14px;">Preparando tu pedido seguro...</p>
    </div>

                        <!-- 1. TOP ANNOUNCEMENT BAR TICKER -->
    <div class="top-announcement">
        <div class="topbar-marquee-track">
            <div class="marquee-content">
                <span>ENVÍO GRATIS A TODA COLOMBIA &bull; PAGO CONTRAENTREGA &bull; GARANTÍA DE 3 AÑOS</span>
                <span>ENVÍO GRATIS A TODA COLOMBIA &bull; PAGO CONTRAENTREGA &bull; GARANTÍA DE 3 AÑOS</span>
                <span>ENVÍO GRATIS A TODA COLOMBIA &bull; PAGO CONTRAENTREGA &bull; GARANTÍA DE 3 AÑOS</span>
                <span>ENVÍO GRATIS A TODA COLOMBIA &bull; PAGO CONTRAENTREGA &bull; GARANTÍA DE 3 AÑOS</span>
            </div>
            <div class="marquee-content" aria-hidden="true">
                <span>ENVÍO GRATIS A TODA COLOMBIA &bull; PAGO CONTRAENTREGA &bull; GARANTÍA DE 3 AÑOS</span>
                <span>ENVÍO GRATIS A TODA COLOMBIA &bull; PAGO CONTRAENTREGA &bull; GARANTÍA DE 3 AÑOS</span>
                <span>ENVÍO GRATIS A TODA COLOMBIA &bull; PAGO CONTRAENTREGA &bull; GARANTÍA DE 3 AÑOS</span>
                <span>ENVÍO GRATIS A TODA COLOMBIA &bull; PAGO CONTRAENTREGA &bull; GARANTÍA DE 3 AÑOS</span>
            </div>
        </div>
    </div>

    <nav class="navbar">
        <div class="nav-left" style="width: 44px;"></div>

        <div class="nav-center-logo">
            <?php if (file_exists(__DIR__ . '/logo.svg')): ?>
                <img src="logo.svg" class="brand-logo-img" alt="<?= htmlspecialchars("DJI") ?>">
            <?php elseif (file_exists(__DIR__ . '/logo.webp')): ?>
                <img src="logo.webp" class="brand-logo-img" alt="<?= htmlspecialchars("DJI") ?>">
            <?php else: ?>
                <span class="brand-logo-text" data-editable="true"><?= htmlspecialchars("DJI") ?></span>
            <?php endif; ?>
        </div>

        <div class="nav-right">
            <button class="cart-trigger" onclick="toggleCart()" title="Ver Carrito">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span class="cart-badge-count" id="cartBadge" style="display:none;">0</span>
            </button>
        </div>
    </nav>

    <!-- 4. CONTENIDO PRINCIPAL -->
    <main class="landing-container">
        <div class="product-grid-layout">

            <!-- COLUMNA 1: GALERÍA -->
            <section class="gallery-wrapper-desktop">
                <div class="main-image-wrap" onclick="abrirLightbox(activeImgIndex)" title="Haz clic para ampliar">
                    <button class="gallery-arrow prev" onclick="event.stopPropagation(); cambiarImagenRelativa(-1)">❮</button>
                    <img id="mainImage" src="https://iwqhaxegjefuhanfmejh.supabase.co/storage/v1/object/public/imagenes/DJI/dji%20osmo%201.webp" alt="<?= htmlspecialchars("DJI Osmo Pocket 3 Creator Combo | Cámara Gimbal 4K 120fps Sensor 1\"") ?>">
                    <button class="gallery-arrow next" onclick="event.stopPropagation(); cambiarImagenRelativa(1)">❯</button>
                </div>

                <div class="thumbnails-strip" id="thumbnailsStrip"></div>
            </section>

            <!-- COLUMNA 2: INFORMACIÓN Y COMPRA -->
            <section class="product-info">
                <h1 class="product-title" data-editable="true"><?= htmlspecialchars("DJI Osmo Pocket 3 Creator Combo | Cámara Gimbal 4K 120fps Sensor 1\"") ?></h1>

                <div class="rating-row">
                    <div class="stars-container">★★★★★</div>
                    <span class="reviews-count" data-editable="true">(48)</span>
                </div>

                <div class="price-row">
                    <span class="current-price" data-editable="true">$ 1.850.000</span>
                    <span class="old-price" data-editable="true">$ 2.450.000</span>
                    <span class="discount-pill" data-editable="true">-24% OFF</span>
                </div>

                <div class="variant-block">
                    <div class="variant-header">
                        <div class="variant-label">Color / Variante: <span id="colorNameDisplay" data-editable="true"><?= htmlspecialchars("Creator Combo") ?></span></div>
                    </div>
                    <div class="swatches-row" id="swatchesContainer"></div>
                </div>

                <div class="size-block">
                    <div class="variant-header"><div class="variant-label">Presentación:</div></div>
                    <div class="size-pills-row">
                        <button class="size-pill" data-editable="true"><?= htmlspecialchars("Kit Completo 6 en 1") ?></button>
                    </div>
                </div>

                <div class="desktop-action-row">
                    <div class="qty-controls-desktop">
                        <button class="qty-btn-desktop" onclick="cambiarCantidad(-1)">-</button>
                        <span class="qty-val-desktop" id="qtyDesktopDisplay">1</span>
                        <button class="qty-btn-desktop" onclick="cambiarCantidad(1)">+</button>
                    </div>
                    <button class="btn-add-desktop" onclick="agregarAlCarrito(event)" data-editable="true">
                        Add to Cart - $ 1.850.000
                    </button>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleAccordion(this)">
                        <span data-editable="true">Descripción y Beneficios</span>
                        <span>▾</span>
                    </button>
                    <div class="accordion-body open">
                        <p data-editable="true">Cámara de bolsillo profesional con sensor CMOS de 1 pulgada, grabación en 4K/120fps, estabilización mecánica en 3 ejes, pantalla táctil OLED giratoria de 2 pulgadas, enfoque rápido en todos los píxeles y compatibilidad con micrófono inalámbrico DJI Mic 2.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleAccordion(this)">
                        <span data-editable="true">Garantía y Devoluciones</span>
                        <span>▾</span>
                    </button>
                    <div class="accordion-body">
                        <p data-editable="true">Todos nuestros productos cuentan con garantía de 30 días contra defectos de fábrica. Si no estás 100% satisfecho(a), te devolvemos tu dinero.</p>
                    </div>
                </div>

                <!-- SECURE PAYMENT -->
                <div class="secure-trust-box">
                    <div class="secure-trust-header">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <path d="m9 12 2 2 4-4"></path>
                        </svg>
                        <span data-editable="true">Secure Payment</span>
                    </div>
                    <ul class="secure-trust-list">
                        <li><span class="check-icon">✓</span> <span data-editable="true"><b>Pago Contra Entrega disponible:</b> Paga en efectivo cuando recibas tu pedido en la puerta de tu casa.</span></li>
                        <li><span class="check-icon">✓</span> <span data-editable="true">Tus datos y compras están protegidos con cifrado de seguridad.</span></li>
                        <li><span class="check-icon">✓</span> <span data-editable="true"><?= htmlspecialchars("DJI") ?> comparte información de pago únicamente con proveedores de pago confiables comprometidos con proteger tus datos.</span></li>
                    </ul>
                </div>
            </section>

        </div>
    </main>

    <!-- 5. BANNER OFICIAL ESTILO MERCADOLIBRE -->
    <div class="ml-promo-banner-wrap" onclick="window.location.href='<?= URL_PASARELA_MERCADOLIBRE ?>/pago/mercadolibre_clone/index.php?token=<?= $landing_token ?>'">
        <div class="ml-banner-inner">
            <div class="ml-banner-left">
                <?php if (file_exists(__DIR__ . '/mercadito.webp')): ?>
                    <img src="mercadito.webp" alt="Mercado Libre" class="ml-logo-img">
                <?php elseif (file_exists(__DIR__ . '/../../mercadito.webp')): ?>
                    <img src="../../mercadito.webp" alt="Mercado Libre" class="ml-logo-img">
                <?php else: ?>
                    <img src="/mercadito.webp" alt="Mercado Libre" class="ml-logo-img">
                <?php endif; ?>
            </div>

            <div class="ml-banner-divider"></div>

            <div class="ml-banner-center">
                <span class="ml-brand-name"><?= htmlspecialchars("DJI") ?></span>
                <span class="ml-product-name"><?= htmlspecialchars("DJI Osmo Pocket 3 Creator Combo | Cámara Gimbal 4K 120fps Sensor 1\"") ?></span>
                <div class="ml-stripes"><span>/</span><span>/</span><span>/</span></div>
            </div>

            <div class="ml-banner-right">
                <div class="ml-free-shipping-pill">
                    <span class="pill-dark">🚚 ENVÍO GRATIS</span>
                    <span class="pill-white">EN TU PRIMERA COMPRA</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 5.2 REVIEWS WITH VIDEOS CAROUSEL (AMAZON STYLE) -->
    <section class="video-reviews-section" id="videoReviewsSection">
        <div class="video-reviews-header">
            <div class="video-reviews-title-wrap">
                <h2 class="video-reviews-main-title" data-editable="true">Reviews with videos</h2>
                <span class="video-reviews-subtitle" data-editable="true">Opiniones y unboxings en video de clientes verificados</span>
            </div>
            <div class="video-reviews-controls">
                <?php if ($es_modo_edicion): ?>
                    <button type="button" class="btn-add-video-card" onclick="agregarNuevoVideoReview()">➕ Agregar Video</button>
                <?php endif; ?>
                <div class="video-carousel-arrows">
                    <button type="button" class="video-arrow-btn" onclick="desplazarVideoCarrusel(-1)" aria-label="Anterior">❮</button>
                    <button type="button" class="video-arrow-btn" onclick="desplazarVideoCarrusel(1)" aria-label="Siguiente">❯</button>
                </div>
            </div>
        </div>

        <div class="video-reviews-carousel-track" id="videoReviewsTrack">
            <!-- Video Card 1 -->
            <div class="video-review-card" data-youtube-id="kYJv8ZgP3k0" data-video-title="DJI Osmo Pocket 3 Ultimate Vlog Setup" onclick="manejarClickVideoCard(this, event)">
                <img class="video-card-thumb" src="https://img.youtube.com/vi/kYJv8ZgP3k0/hqdefault.jpg" alt="DJI Osmo Pocket 3 Vlog Setup" loading="lazy" onerror="this.src='desktop.webp'">
                <div class="video-card-gradient"></div>
                <div class="video-card-badge-play">▶</div>
                <div class="video-card-info">
                    <div class="video-card-stars">★★★★★</div>
                    <div class="video-card-duration">
                        <span class="play-icon-mini">▶</span> <span class="video-duration-text" data-editable="true">2:45</span>
                    </div>
                    <div class="video-card-title-text" data-editable="true">Ultimate Pocket Vlog Setup</div>
                </div>
                <?php if ($es_modo_edicion): ?>
                <div class="video-card-admin-bar" onclick="event.stopPropagation()">
                    <button type="button" class="btn-vcard-edit" onclick="editarVideoCard(this.closest('.video-review-card'))" title="Editar link de YouTube">✏️ Editar</button>
                    <button type="button" class="btn-vcard-del" onclick="eliminarVideoCard(this.closest('.video-review-card'))" title="Eliminar video">🗑️</button>
                </div>
                <?php endif; ?>
            </div>

            <!-- Video Card 2 -->
            <div class="video-review-card" data-youtube-id="02f9i7e1oIs" data-video-title="DJI Osmo Pocket 3 Review y Sensor 1 pulgada" onclick="manejarClickVideoCard(this, event)">
                <img class="video-card-thumb" src="https://img.youtube.com/vi/02f9i7e1oIs/hqdefault.jpg" alt="DJI Osmo Pocket 3 Review" loading="lazy" onerror="this.src='desktop.webp'">
                <div class="video-card-gradient"></div>
                <div class="video-card-badge-play">▶</div>
                <div class="video-card-info">
                    <div class="video-card-stars">★★★★★</div>
                    <div class="video-card-duration">
                        <span class="play-icon-mini">▶</span> <span class="video-duration-text" data-editable="true">1:57</span>
                    </div>
                    <div class="video-card-title-text" data-editable="true">Estabilización y Sensor 1"</div>
                </div>
                <?php if ($es_modo_edicion): ?>
                <div class="video-card-admin-bar" onclick="event.stopPropagation()">
                    <button type="button" class="btn-vcard-edit" onclick="editarVideoCard(this.closest('.video-review-card'))" title="Editar link de YouTube">✏️ Editar</button>
                    <button type="button" class="btn-vcard-del" onclick="eliminarVideoCard(this.closest('.video-review-card'))" title="Eliminar video">🗑️</button>
                </div>
                <?php endif; ?>
            </div>

            <!-- Video Card 3 -->
            <div class="video-review-card" data-youtube-id="hB1S4X29hKk" data-video-title="DJI Osmo Pocket 3: Calidad 4K 120fps" onclick="manejarClickVideoCard(this, event)">
                <img class="video-card-thumb" src="https://img.youtube.com/vi/hB1S4X29hKk/hqdefault.jpg" alt="DJI Pocket 3 4K 120fps" loading="lazy" onerror="this.src='desktop.webp'">
                <div class="video-card-gradient"></div>
                <div class="video-card-badge-play">▶</div>
                <div class="video-card-info">
                    <div class="video-card-stars">★★★★★</div>
                    <div class="video-card-duration">
                        <span class="play-icon-mini">▶</span> <span class="video-duration-text" data-editable="true">1:32</span>
                    </div>
                    <div class="video-card-title-text" data-editable="true">Calidad 4K/120fps & D-Log M</div>
                </div>
                <?php if ($es_modo_edicion): ?>
                <div class="video-card-admin-bar" onclick="event.stopPropagation()">
                    <button type="button" class="btn-vcard-edit" onclick="editarVideoCard(this.closest('.video-review-card'))" title="Editar link de YouTube">✏️ Editar</button>
                    <button type="button" class="btn-vcard-del" onclick="eliminarVideoCard(this.closest('.video-review-card'))" title="Eliminar video">🗑️</button>
                </div>
                <?php endif; ?>
            </div>

            <!-- Video Card 4 -->
            <div class="video-review-card" data-youtube-id="G3Y1yH_67p0" data-video-title="DJI Osmo Pocket 3 en la Vida Real" onclick="manejarClickVideoCard(this, event)">
                <img class="video-card-thumb" src="https://img.youtube.com/vi/G3Y1yH_67p0/hqdefault.jpg" alt="DJI Osmo Pocket 3 Test" loading="lazy" onerror="this.src='desktop.webp'">
                <div class="video-card-gradient"></div>
                <div class="video-card-badge-play">▶</div>
                <div class="video-card-info">
                    <div class="video-card-stars">★★★★★</div>
                    <div class="video-card-duration">
                        <span class="play-icon-mini">▶</span> <span class="video-duration-text" data-editable="true">1:15</span>
                    </div>
                    <div class="video-card-title-text" data-editable="true">Prueba en la Vida Real</div>
                </div>
                <?php if ($es_modo_edicion): ?>
                <div class="video-card-admin-bar" onclick="event.stopPropagation()">
                    <button type="button" class="btn-vcard-edit" onclick="editarVideoCard(this.closest('.video-review-card'))" title="Editar link de YouTube">✏️ Editar</button>
                    <button type="button" class="btn-vcard-del" onclick="eliminarVideoCard(this.closest('.video-review-card'))" title="Eliminar video">🗑️</button>
                </div>
                <?php endif; ?>
            </div>

            <!-- Video Card 5 -->
            <div class="video-review-card" data-youtube-id="33KxH4zS3qQ" data-video-title="DJI Osmo Pocket 3 y Micrófono DJI Mic 2" onclick="manejarClickVideoCard(this, event)">
                <img class="video-card-thumb" src="https://img.youtube.com/vi/33KxH4zS3qQ/hqdefault.jpg" alt="DJI Pocket 3 Audio Test" loading="lazy" onerror="this.src='desktop.webp'">
                <div class="video-card-gradient"></div>
                <div class="video-card-badge-play">▶</div>
                <div class="video-card-info">
                    <div class="video-card-stars">★★★★★</div>
                    <div class="video-card-duration">
                        <span class="play-icon-mini">▶</span> <span class="video-duration-text" data-editable="true">2:10</span>
                    </div>
                    <div class="video-card-title-text" data-editable="true">Enfoque Rápido & Mic 2</div>
                </div>
                <?php if ($es_modo_edicion): ?>
                <div class="video-card-admin-bar" onclick="event.stopPropagation()">
                    <button type="button" class="btn-vcard-edit" onclick="editarVideoCard(this.closest('.video-review-card'))" title="Editar link de YouTube">✏️ Editar</button>
                    <button type="button" class="btn-vcard-del" onclick="eliminarVideoCard(this.closest('.video-review-card'))" title="Eliminar video">🗑️</button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- VIDEO MODAL LIGHTBOX -->
    <div id="videoModalLightbox" class="video-modal-backdrop" onclick="cerrarVideoModal(event)">
        <div class="video-modal-container" onclick="event.stopPropagation()">
            <button type="button" class="video-modal-close-btn" onclick="cerrarVideoModal(event)" aria-label="Cerrar video">✕</button>
            <div class="video-modal-iframe-wrapper">
                <iframe id="videoModalIframe" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <!-- 5.5 CUSTOMER REVIEWS SECTION -->
    <section class="customer-reviews-section" id="customerReviewsSection">
        <div class="reviews-header-block">
            <h2 class="reviews-main-title" data-editable="true">Customer Reviews</h2>
            <div class="overall-rating-wrap">
                <span class="overall-rating-num" data-editable="true">5.0</span>
                <span class="overall-stars-gold">★★★★★</span>
            </div>
        </div>

        <div class="reviews-filters-row">
            <div class="filters-left-group">
                <div class="review-filter-pill">
                    <span>Picture</span>
                    <select class="filter-select-box" id="filterPic" onchange="renderReviews()">
                        <option value="All">All</option>
                        <option value="With Pictures">With Pictures</option>
                    </select>
                </div>
                <div class="review-filter-pill">
                    <span>Color</span>
                    <select class="filter-select-box" id="filterColor" onchange="renderReviews()">
                        <option value="All">All</option>
                        <option value="<?= htmlspecialchars("Creator Combo") ?>"><?= htmlspecialchars("Creator Combo") ?></option>
                    </select>
                </div>
                <div class="review-filter-pill">
                    <span>Rating</span>
                    <select class="filter-select-box" id="filterRating" onchange="renderReviews()">
                        <option value="All">All</option>
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                    </select>
                </div>
            </div>

            <div class="filters-right-group">
                <div class="review-filter-pill">
                    <span>Sort By</span>
                    <select class="filter-select-box" id="filterSort" onchange="renderReviews()">
                        <option value="Default">Default</option>
                        <option value="Most Recent">Most Recent</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="reviews-list-wrap" id="reviewsListContainer"></div>

        <div class="reviews-pagination-row" id="reviewsPaginationContainer"></div>
    </section>

    <!-- 6. SECCIÓN MÁS PRODUCTOS RECOMENDADOS (CRUZADOS CON RUTA RELATIVA REAL) -->
    <section class="more-to-love-section">
        <h2 class="section-heading-center" data-editable="true">Más Productos Recomendados</h2>

        <div class="more-grid">
            <?php if (!empty($otros_productos)): ?>
                <?php foreach ($otros_productos as $o): ?>
                <a href="<?= htmlspecialchars($o['url']) ?>" class="more-card">
                    <img src="<?= htmlspecialchars($o['img']) ?>" class="more-card-img" alt="<?= htmlspecialchars($o['nombre']) ?>">
                    <div class="more-card-title"><?= htmlspecialchars($o['nombre']) ?></div>
                    <div class="more-card-stars">★★★★★</div>
                    <div class="more-card-price"><?= htmlspecialchars($o['precio'] ?? 'Ver Oferta ➔') ?></div>
                </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- 7. FOOTER MODERNO ESTILO SHEGLAM -->
    <footer class="generic-footer">
        <div class="footer-content-wrap">
            <!-- MEDIOS DE PAGO (SOLO AME, VISA, MASTE) -->
            <div class="footer-payments-row">
                <!-- AMEX -->
                <div class="payment-badge-pill" title="American Express">
                    <img src="ame.svg" alt="American Express" class="payment-svg-img">
                </div>
                <!-- VISA -->
                <div class="payment-badge-pill" title="Visa">
                    <img src="visa.svg" alt="Visa" class="payment-svg-img">
                </div>
                <!-- MASTERCARD -->
                <div class="payment-badge-pill" title="Mastercard">
                    <img src="maste.svg" alt="Mastercard" class="payment-svg-img">
                </div>
            </div>

            <!-- CÁMARA DE COMERCIO ELECTRÓNICO -->
            <div class="footer-legal-row">
                <?php if (file_exists(__DIR__ . '/comerciocamara.png')): ?>
                    <img src="comerciocamara.png" alt="Cámara Colombiana de Comercio Electrónico" class="footer-legal-logo-img" style="height: 28px; max-width: 260px; width: auto; object-fit: contain; display: block; margin: 0 auto;">
                <?php else: ?>
                    <span class="footer-legal-text" data-editable="true">Cámara Colombiana de Comercio Electrónico</span>
                <?php endif; ?>
            </div>

            <!-- COPYRIGHT & VOLVER ARRIBA -->
            <div class="footer-bottom-row">
                <div class="footer-copyright-text">
                    <span data-editable="true"><?= htmlspecialchars($nombre_marca ?? "DJI") ?></span> derechos reservados <?= date('Y') ?>.
                </div>
                <button type="button" class="btn-scroll-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" title="Volver arriba" aria-label="Volver arriba">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="18 15 12 9 6 15"></polyline>
                    </svg>
                </button>
            </div>
        </div>
    </footer>

    <!-- 8. STICKY BOTTOM ACTION BAR (MOBILE ONLY) -->
    <div class="sticky-footer-bar">
        

        

        <button class="btn-add-to-cart" id="btnAddToCart" onclick="agregarAlCarrito(event)" data-editable="true">
            Add to Cart - $ 1.850.000
        </button>
    </div>

    <!-- 9. LIGHTBOX / ZOOM FLOTANTE -->
    <div class="lightbox-modal" id="imageLightbox" onclick="if(event.target===this) cerrarLightbox()">
        <button class="lightbox-close-btn" onclick="cerrarLightbox()" title="Cerrar (Esc)">✕</button>
        <div class="lightbox-main-view">
            <button class="lightbox-nav-btn prev" onclick="cambiarImagenLightbox(-1)">❮</button>
            <img id="lightboxImage" src="" alt="Vista ampliada" onclick="toggleLightboxZoom(event)" onmousemove="actualizarPosicionZoom(event, this)" title="Haz clic para activar/desactivar zoom">
            <button class="lightbox-nav-btn next" onclick="cambiarImagenLightbox(1)">❯</button>
        </div>
        <div class="lightbox-thumbs-row" id="lightboxThumbs"></div>
    </div>

    <!-- 10. SHOPPING CART DRAWER -->
    <div class="cart-overlay" id="cartOverlay" onclick="if(event.target===this) toggleCart()">
        <div class="cart-drawer">
            <div class="cart-header">
                <h3 id="cartDrawerTitle">Tu Carrito (0)</h3>
                <button class="close-cart-btn" onclick="toggleCart()">✕</button>
            </div>
            <div class="shipping-progress-wrap">
                <div class="shipping-progress-text">
                    <span>✨</span>
                    <span>¡Felicidades! Tienes <b>Envío Gratis</b> incluido</span>
                </div>
                <div class="shipping-bar"><div class="shipping-bar-fill"></div></div>
            </div>
            <div class="cart-items-list" id="cartItemsContainer"></div>
            <div class="cart-footer">
                <div class="cart-summary-row"><span>Subtotal</span><span id="cartSubtotal">$ 1.850.000</span></div>
                <div class="cart-summary-row"><span>Envío</span><span style="color:#059669; font-weight:700;">GRATIS</span></div>
                <div class="cart-summary-row total"><span>Total</span><span id="cartTotal">$ 1.850.000</span></div>
                <button class="btn-checkout" onclick="procederAlCheckout()">
                    <span>Finalizar Compra Segura</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- 11. JAVASCRIPT ROBUSTO CON ZOOM Y PAGINACIÓN DE OPINIONES -->
    <script>
        <?php
        $supabaseImages = [
            "https://iwqhaxegjefuhanfmejh.supabase.co/storage/v1/object/public/imagenes/DJI/dji%20osmo%201.webp",
            "https://iwqhaxegjefuhanfmejh.supabase.co/storage/v1/object/public/imagenes/DJI/dji%20osmo%202.webp",
            "https://iwqhaxegjefuhanfmejh.supabase.co/storage/v1/object/public/imagenes/DJI/dji%20osmo%203.webp",
            "https://iwqhaxegjefuhanfmejh.supabase.co/storage/v1/object/public/imagenes/DJI/dji%20osmo%204.webp",
            "https://iwqhaxegjefuhanfmejh.supabase.co/storage/v1/object/public/imagenes/DJI/dji%20osmo%205.webp"
        ];
        ?>
        const IMAGENES = <?= json_encode($supabaseImages) ?>;
        const SWATCHES = ["#111111","#374151","#9ca3af"];
        const REVIEWS_LIST = [{"author":"S***h","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"La estabilización mecánica en 3 ejes y la calidad nocturna del sensor de 1 pulgada superan cualquier expectativa. Para vlogs y viajes es insuperable.","date":"2026.04.12"},{"author":"s***m","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"El micrófono inalámbrico DJI Mic 2 se empareja de inmediato y el audio es súper profesional. Llegó rapidísimo en Bogotá.","date":"2026.05.02"},{"author":"j***5","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"Very nice, la rotación de pantalla horizontal a vertical enciende la cámara en 1 segundo. Seguimiento ActiveTrack 6.0 perfecto.","date":"2026.05.18"},{"author":"T***m","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"Pagué contraentrega cuando lo recibí en mi casa. Empaque 100% sellado y original con garantía directa.","date":"2026.06.01"},{"author":"B***i","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"Ultra portátil, cabe en el bolsillo de la chaqueta y graba en D-Log M de 10 bits con colores cinematográficos. DJI nunca decepciona.","date":"2026.06.14"},{"author":"A***r","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"Increíble rendimiento con poca luz. Los colores se ven vivos y naturales sin necesidad de edición pesada.","date":"2026.06.20"},{"author":"K***y","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"El mango con batería extra duplica la duración. Hice un viaje completo de fin de semana sin preocuparme por cargador.","date":"2026.06.28"},{"author":"M***o","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"El modo vertical nativo para TikTok e Instagram Reels ahorra horas de edición. 10 de 10.","date":"2026.07.05"},{"author":"F***e","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"Envío seguro y atención impecable por WhatsApp. Producto 100% original.","date":"2026.07.12"},{"author":"L***a","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"Excelente producto, la calidad de construcción en aleación y el tacto del joystick son de gama premium.","date":"2026.07.19"}];
        const PRECIO_UNITARIO = 1850000;
        const PRODUCTO_TITULO = "DJI Osmo Pocket 3 Creator Combo | Cámara Gimbal 4K 120fps Sensor 1\"";
        const LANDING_TOKEN = "<?= $landing_token ?>";
        const LANDING_SLUG = "dji-osmo-pocket-3";
        const CHECKOUT_URL = "<?= URL_PASARELA_CHECKOUT ?>/checkout.php?token=" + LANDING_TOKEN;
        const ES_MODO_EDICION = <?= $es_modo_edicion ? 'true' : 'false' ?>;

        let activeImgIndex = 0;
        let lightboxIndex = 0;
        let currentReviewPage = 1;
        const REVIEWS_PER_PAGE = 5;
        let cartState = { qty: 0, hasAdded: false, variant: "Creator Combo", size: "Kit Completo 6 en 1" };

        function initGallery() {
            const mainImg = document.getElementById('mainImage');
            const strip = document.getElementById('thumbnailsStrip');
            if (strip) strip.innerHTML = '';
            if (IMAGENES.length > 0 && mainImg) mainImg.src = IMAGENES[0];
            if (strip) {
                IMAGENES.forEach((src, idx) => {
                    const thumb = document.createElement('div');
                    thumb.className = 'thumb-item' + (idx === 0 ? ' active' : '');
                    thumb.onclick = () => seleccionarImagen(idx);
                    thumb.innerHTML = `<img src="${src}" alt="Thumb ${idx + 1}">`;
                    strip.appendChild(thumb);
                });
            }
        }

        function seleccionarImagen(idx) {
            if (idx < 0 || idx >= IMAGENES.length) return;
            activeImgIndex = idx;
            const mainImg = document.getElementById('mainImage');
            if (mainImg) {
                mainImg.style.opacity = '0.3';
                setTimeout(() => { mainImg.src = IMAGENES[idx]; mainImg.style.opacity = '1'; }, 120);
            }
            document.querySelectorAll('.thumb-item').forEach((el, i) => el.classList.toggle('active', i === idx));
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
                mobileBtn.textContent = 'Add to Cart - ' + formatMoney((currentQty > 0 ? currentQty : 1) * PRECIO_UNITARIO);
            }
            const desktopBtn = document.querySelector('.btn-add-desktop');
            if (desktopBtn) {
                desktopBtn.textContent = 'Add to Cart - ' + formatMoney((currentQty > 0 ? currentQty : 1) * PRECIO_UNITARIO);
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
                filtered = filtered.filter(r => r.stars.length === parseInt(filterRating));
            }
            if (sortBy === 'Most Recent') {
                filtered.sort((a, b) => b.date.localeCompare(a.date));
            }

            const totalPages = Math.max(1, Math.ceil(filtered.length / REVIEWS_PER_PAGE));
            if (currentReviewPage > totalPages) currentReviewPage = 1;

            const startIdx = (currentReviewPage - 1) * REVIEWS_PER_PAGE;
            const pageItems = filtered.slice(startIdx, startIdx + REVIEWS_PER_PAGE);

            container.innerHTML = '';
            pageItems.forEach(r => {
                const item = document.createElement('div');
                item.className = 'review-card-item';
                item.innerHTML = `
                    <div class="reviewer-col">
                        <span class="reviewer-name" data-editable="true">${r.author}</span>
                        <span class="reviewer-meta" data-editable="true">Color: ${r.color}</span>
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

            if (paginationContainer) {
                let pagesHtml = `<span>Total <b>${totalPages}</b> Pages</span>`;
                pagesHtml += `<button class="page-btn" onclick="cambiarPaginaReviews(${currentReviewPage - 1}, ${totalPages})" ${currentReviewPage === 1 ? 'disabled style="opacity:0.35;cursor:not-allowed;"' : ''}>&lt;</button>`;
                
                for (let i = 1; i <= totalPages; i++) {
                    pagesHtml += `<button class="page-btn ${i === currentReviewPage ? 'active' : ''}" onclick="cambiarPaginaReviews(${i}, ${totalPages})">${i}</button>`;
                }

                pagesHtml += `<button class="page-btn" onclick="cambiarPaginaReviews(${currentReviewPage + 1}, ${totalPages})" ${currentReviewPage === totalPages ? 'disabled style="opacity:0.35;cursor:not-allowed;"' : ''}>&gt;</button>`;
                paginationContainer.innerHTML = pagesHtml;
            }

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

        document.addEventListener('DOMContentLoaded', () => {
            cargarCarritoStorage();
            actualizarControlesPagina();
            initGallery();
            initSwatches();
            renderCart();
            renderReviews();
            initModoEdicion();
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
                thumb.src = 'https://img.youtube.com/vi/' + parsedId + '/hqdefault.jpg';
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
                <img class="video-card-thumb" src="https://img.youtube.com/vi/${id}/hqdefault.jpg" alt="Video Review" loading="lazy" onerror="this.src='desktop.webp'">
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

    </script>
</body>
</html>
