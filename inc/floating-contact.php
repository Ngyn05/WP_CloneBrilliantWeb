<?php
/**
 * Global Floating Contact Widget - Brilliant Việt Nam Vietnam
 * Monochrome Black & White Luxury Aesthetic
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<!-- Floating Contact Button & Popup Container -->
<div id="blFloatingContact" class="bl-floating-contact">
  
  <!-- 1. Floating Action Button with Animated Pulse Rings -->
  <div class="bl-fab-wrap">
    <div class="bl-fab-ring bl-fab-ring--1"></div>
    <div class="bl-fab-ring bl-fab-ring--2"></div>
    <button type="button" class="bl-fab-btn" id="blFabBtn" onclick="blToggleContactPopup()" aria-label="Liên hệ Brilliant Việt Nam" title="Liên hệ tư vấn">
      <svg class="bl-fab-icon bl-fab-icon--phone" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
      </svg>
      <svg class="bl-fab-icon bl-fab-icon--close" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
    </button>
  </div>

  <!-- 2. Quick Contact Menu Popup -->
  <div class="bl-contact-popup" id="blContactPopup">
    <!-- Header -->
    <div class="bl-popup-header">
      <div class="bl-popup-header__info">
        <span class="bl-popup-badge">BRILLIANT VIỆT NAM</span>
        <h4 class="bl-popup-title">Liên hệ với chúng tôi</h4>
      </div>
      <button type="button" class="bl-popup-close-btn" onclick="blCloseContactPopup()" aria-label="Đóng popup">&times;</button>
    </div>

    <!-- Contact List Cards -->
    <div class="bl-popup-body">
      
      <!-- Option 1: Hotline -->
      <a href="tel:1900638400" class="bl-popup-item bl-popup-item--hotline" title="Gọi tổng đài Hotline">
        <div class="bl-popup-item__icon bl-popup-item__icon--hotline">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
          </svg>
        </div>
        <div class="bl-popup-item__content">
          <span class="bl-popup-item__label">Số điện thoại Hotline</span>
          <strong class="bl-popup-item__value">1900.63.8400</strong>
        </div>
        <div class="bl-popup-item__arrow">&rarr;</div>
      </a>

      <!-- Option 2: Zalo Chat -->
      <a href="https://zalo.me/0917834532" target="_blank" rel="noopener noreferrer" class="bl-popup-item bl-popup-item--zalo" title="Chat qua Zalo tư vấn">
        <div class="bl-popup-item__icon bl-popup-item__icon--zalo">
          <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M24 4C12.95 4 4 12.5 4 23c0 5.9 2.84 11.2 7.28 14.71L9.5 44l6.77-2.49C18.66 42.47 21.28 43 24 43c11.05 0 20-8.5 20-19S35.05 4 24 4z" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round" fill="none"/>
            <text x="24" y="27.5" font-family="'Archivo', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif" font-size="10.5" font-weight="900" text-anchor="middle" fill="currentColor" letter-spacing="0.5">ZALO</text>
          </svg>
        </div>
        <div class="bl-popup-item__content">
          <span class="bl-popup-item__label">Chat qua Zalo</span>
          <strong class="bl-popup-item__subtext">Nhắn tin tư vấn ngay</strong>
        </div>
        <div class="bl-popup-item__arrow">&rarr;</div>
      </a>

      <!-- Option 3: Office System -->
      <button type="button" class="bl-popup-item bl-popup-item--office" onclick="blOpenOfficesModal()" title="Xem hệ thống văn phòng">
        <div class="bl-popup-item__icon bl-popup-item__icon--office">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
            <circle cx="12" cy="10" r="3"></circle>
          </svg>
        </div>
        <div class="bl-popup-item__content">
          <span class="bl-popup-item__label">Công ty Brilliant Việt Nam</span>
          <strong class="bl-popup-item__subtext">Xem hệ thống văn phòng</strong>
        </div>
        <div class="bl-popup-item__arrow">&rarr;</div>
      </button>

    </div>
  </div>

</div>

<!-- 3. Offices Modal (Hệ thống văn phòng chi nhánh) -->
<div id="blOfficesModal" class="bl-offices-modal-overlay" onclick="blCloseOfficesModalOnBackdrop(event)">
  <div class="bl-offices-modal-container" role="dialog" aria-modal="true" aria-labelledby="blOfficesModalTitle">
    
    <!-- Modal Header -->
    <div class="bl-offices-modal-header">
      <div class="bl-offices-header-left">
        <div class="bl-offices-header-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
            <path d="M9 22v-4h6v4"></path>
            <path d="M8 6h.01"></path>
            <path d="M16 6h.01"></path>
            <path d="M8 10h.01"></path>
            <path d="M16 10h.01"></path>
            <path d="M8 14h.01"></path>
            <path d="M16 14h.01"></path>
          </svg>
        </div>
        <div>
          <span class="bl-offices-sub">BRILLIANT VIỆT NAM</span>
          <h3 id="blOfficesModalTitle" class="bl-offices-title">Hệ thống văn phòng</h3>
        </div>
      </div>
      <button type="button" class="bl-offices-close" onclick="blCloseOfficesModal()" aria-label="Đóng">&times;</button>
    </div>

    <!-- Modal Body: 2 Columns Office Grid -->
    <div class="bl-offices-modal-body">
      <div class="bl-offices-grid">
        
        <!-- Chi nhánh 1: Hà Nội -->
        <div class="bl-office-card">
          <div class="bl-office-card__top">
            <span class="bl-office-tag">HÀ NỘI</span>
            <span class="bl-office-region">Chi nhánh miền Bắc</span>
          </div>

          <h4 class="bl-office-name">Công ty Brilliant Việt Nam – Chi nhánh Hà Nội</h4>

          <div class="bl-office-info-list">
            <!-- Địa chỉ -->
            <div class="bl-office-info-item">
              <div class="bl-office-info-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                  <circle cx="12" cy="10" r="3"></circle>
                </svg>
              </div>
              <div class="bl-office-info-text">
                <strong>Địa chỉ</strong>
                <p>Số 226 Đường Láng, Phường Thịnh Quang, Quận Đống Đa, Hà Nội</p>
                <a href="https://maps.google.com/?q=226+Đường+Láng,+Thịnh+Quang,+Đống+Đa,+Hà+Nội" target="_blank" rel="noopener noreferrer" class="bl-office-map-link">
                  Xem trên Google Maps &rarr;
                </a>
              </div>
            </div>

            <!-- Điện thoại -->
            <div class="bl-office-info-item">
              <div class="bl-office-info-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
              </div>
              <div class="bl-office-info-text">
                <strong>Điện thoại</strong>
                <p><a href="tel:02473048700" class="bl-office-contact-link">024.7304.8700</a></p>
              </div>
            </div>

            <!-- Email -->
            <div class="bl-office-info-item">
              <div class="bl-office-info-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                  <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
              </div>
              <div class="bl-office-info-text">
                <strong>Email</strong>
                <p><a href="mailto:contact@brilliantvietnam.com" class="bl-office-contact-link">contact@brilliantvietnam.com</a></p>
              </div>
            </div>

            <!-- Giờ làm việc -->
            <div class="bl-office-info-item">
              <div class="bl-office-info-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
              </div>
              <div class="bl-office-info-text">
                <strong>Giờ làm việc</strong>
                <p>7:00 – 21:00 • Tất cả các ngày trong tuần</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Chi nhánh 2: TP. Hồ Chí Minh -->
        <div class="bl-office-card">
          <div class="bl-office-card__top">
            <span class="bl-office-tag">TP. HỒ CHÍ MINH</span>
            <span class="bl-office-region">Chi nhánh miền Nam</span>
          </div>

          <h4 class="bl-office-name">Công ty Brilliant Việt Nam – Chi nhánh Hồ Chí Minh</h4>

          <div class="bl-office-info-list">
            <!-- Địa chỉ -->
            <div class="bl-office-info-item">
              <div class="bl-office-info-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                  <circle cx="12" cy="10" r="3"></circle>
                </svg>
              </div>
              <div class="bl-office-info-text">
                <strong>Địa chỉ</strong>
                <p>Số 137 Đường Hòa Hưng, Phường Hòa Hưng, TP. Hồ Chí Minh</p>
                <a href="https://maps.google.com/?q=137+Hòa+Hưng,+Phường+12,+Quận+10,+Hồ+Chí+Minh" target="_blank" rel="noopener noreferrer" class="bl-office-map-link">
                  Xem trên Google Maps &rarr;
                </a>
              </div>
            </div>

            <!-- Điện thoại -->
            <div class="bl-office-info-item">
              <div class="bl-office-info-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
              </div>
              <div class="bl-office-info-text">
                <strong>Điện thoại</strong>
                <p><a href="tel:02873048700" class="bl-office-contact-link">028.7304.8700</a></p>
              </div>
            </div>

            <!-- Email -->
            <div class="bl-office-info-item">
              <div class="bl-office-info-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                  <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
              </div>
              <div class="bl-office-info-text">
                <strong>Email</strong>
                <p><a href="mailto:contact@brilliantvietnam.com" class="bl-office-contact-link">contact@brilliantvietnam.com</a></p>
              </div>
            </div>

            <!-- Giờ làm việc -->
            <div class="bl-office-info-item">
              <div class="bl-office-info-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
              </div>
              <div class="bl-office-info-text">
                <strong>Giờ làm việc</strong>
                <p>8:00 – 20:30 • Thứ 2 đến Thứ 7</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Modal Footer Call To Action -->
    <div class="bl-offices-modal-footer">
      <div class="bl-offices-footer-text">
        <strong>Cần tư vấn ngay?</strong>
        <span>Đội ngũ Brilliant luôn sẵn sàng hỗ trợ bạn</span>
      </div>
      <a href="tel:1900638400" class="bl-offices-hotline-btn" title="Gọi hotline 1900.63.8400">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
        </svg>
        <span>HOTLINE 1900.63.8400</span>
      </a>
    </div>

  </div>
</div>

<style>
/* ==========================================================================
   BRILLIANT FLOATING CONTACT WIDGET - MONOCHROME LUXURY (PURE BLACK & WHITE)
   ========================================================================== */
.bl-floating-contact {
  position: fixed;
  bottom: 28px;
  right: 28px;
  z-index: 999990;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

/* 1. Floating Action Button & Wave Animations */
.bl-fab-wrap {
  position: relative;
  width: 58px;
  height: 58px;
}

.bl-fab-btn {
  position: relative;
  width: 58px;
  height: 58px;
  border-radius: 50%;
  background: #ffffff;
  color: #000000;
  border: 2px solid #ffffff;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.2);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  z-index: 5;
  transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), background 0.2s ease, box-shadow 0.25s ease;
  padding: 0;
  outline: none;
}

.bl-fab-btn:hover {
  transform: scale(1.08);
  background: #f0f0f0;
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.6), 0 0 16px rgba(255, 255, 255, 0.6);
}

.bl-fab-icon {
  position: absolute;
  transition: transform 0.25s ease, opacity 0.2s ease;
}

.bl-fab-icon--phone {
  opacity: 1;
  transform: rotate(0deg) scale(1);
}

.bl-fab-icon--close {
  opacity: 0;
  transform: rotate(-90deg) scale(0.5);
}

.bl-floating-contact.bl-active .bl-fab-icon--phone {
  opacity: 0;
  transform: rotate(90deg) scale(0.5);
}

.bl-floating-contact.bl-active .bl-fab-icon--close {
  opacity: 1;
  transform: rotate(0deg) scale(1);
}

.bl-floating-contact.bl-active .bl-fab-btn {
  background: #111111;
  color: #ffffff;
  border-color: #333333;
}

/* Pulsing Wave Rings (Pure White & Subtle Monochrome) */
.bl-fab-ring {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 50%;
  border: 1.5px solid rgba(255, 255, 255, 0.6);
  pointer-events: none;
  z-index: 1;
  animation: blFabPulse 2.8s infinite cubic-bezier(0.215, 0.61, 0.355, 1);
}

.bl-fab-ring--2 {
  animation-delay: 1.4s;
}

.bl-floating-contact.bl-active .bl-fab-ring {
  display: none;
}

@keyframes blFabPulse {
  0% {
    transform: scale(1);
    opacity: 0.8;
  }
  50% {
    opacity: 0.35;
  }
  100% {
    transform: scale(1.85);
    opacity: 0;
  }
}

/* 2. Quick Contact Menu Popup */
.bl-contact-popup {
  position: absolute;
  bottom: 74px;
  right: 0;
  width: 320px;
  background: #121212;
  border: 1px solid #2a2a2a;
  border-radius: 20px;
  box-shadow: 0 16px 40px rgba(0, 0, 0, 0.7), 0 0 0 1px rgba(255, 255, 255, 0.08);
  overflow: hidden;
  opacity: 0;
  visibility: hidden;
  transform: translateY(16px) scale(0.95);
  transform-origin: bottom right;
  transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
  z-index: 10;
}

.bl-floating-contact.bl-active .bl-contact-popup {
  opacity: 1;
  visibility: visible;
  transform: translateY(0) scale(1);
}

/* Popup Header */
.bl-popup-header {
  background: #181818;
  border-bottom: 1px solid #262626;
  padding: 16px 18px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.bl-popup-badge {
  display: inline-block;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 0.08em;
  color: #888888;
  text-transform: uppercase;
  margin-bottom: 2px;
}

.bl-popup-title {
  margin: 0;
  font-size: 15px;
  font-weight: 700;
  color: #ffffff;
}

.bl-popup-close-btn {
  background: transparent;
  border: none;
  color: #888888;
  font-size: 22px;
  line-height: 1;
  cursor: pointer;
  padding: 4px;
  border-radius: 6px;
  transition: color 0.2s ease;
}

.bl-popup-close-btn:hover {
  color: #ffffff;
}

/* Popup Body Items */
.bl-popup-body {
  padding: 12px;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.bl-popup-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 14px;
  background: #1c1c1c;
  border: 1px solid #282828;
  border-radius: 14px;
  text-decoration: none !important;
  color: #ffffff;
  cursor: pointer;
  transition: all 0.2s ease;
  width: 100%;
  box-sizing: border-box;
  text-align: left;
}

.bl-popup-item:hover {
  background: #242424;
  border-color: #444444;
  transform: translateX(-2px);
}

.bl-popup-item__icon {
  width: 40px;
  height: 40px;
  border-radius: 12px;
  background: #000000;
  border: 1px solid #333333;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  color: #ffffff;
  transition: all 0.2s ease;
}

.bl-popup-item:hover .bl-popup-item__icon {
  background: #ffffff;
  color: #000000;
  border-color: #ffffff;
}

.bl-popup-item__content {
  flex: 1;
  min-width: 0;
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.bl-popup-item__label {
  font-size: 11.5px;
  color: #888888;
  font-weight: 500;
}

.bl-popup-item__value {
  font-size: 15px;
  font-weight: 700;
  color: #ffffff;
  letter-spacing: 0.3px;
}

.bl-popup-item__subtext {
  font-size: 13.5px;
  font-weight: 600;
  color: #ffffff;
}

.bl-popup-item__arrow {
  color: #666666;
  font-size: 16px;
  transition: transform 0.2s ease, color 0.2s ease;
}

.bl-popup-item:hover .bl-popup-item__arrow {
  color: #ffffff;
  transform: translateX(3px);
}

/* 3. Offices Modal (Full Luxury Monochrome Modal) */
.bl-offices-modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.82);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 999999;
  padding: 16px;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.25s ease, visibility 0.25s ease;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

.bl-offices-modal-overlay.bl-modal--active {
  opacity: 1;
  visibility: visible;
}

.bl-offices-modal-container {
  background: #141414;
  border: 1px solid #282828;
  border-radius: 22px;
  width: 100%;
  max-width: 820px;
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: 0 24px 60px rgba(0, 0, 0, 0.8), 0 0 0 1px rgba(255, 255, 255, 0.1);
  transform: scale(0.96) translateY(12px);
  transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
  box-sizing: border-box;
}

.bl-offices-modal-overlay.bl-modal--active .bl-offices-modal-container {
  transform: scale(1) translateY(0);
}

/* Modal Header */
.bl-offices-modal-header {
  background: #1a1a1a;
  border-bottom: 1px solid #2a2a2a;
  padding: 20px 24px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.bl-offices-header-left {
  display: flex;
  align-items: center;
  gap: 14px;
}

.bl-offices-header-icon {
  width: 44px;
  height: 44px;
  border-radius: 12px;
  background: #000000;
  border: 1px solid #333333;
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.bl-offices-sub {
  display: block;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.1em;
  color: #888888;
  text-transform: uppercase;
  margin-bottom: 2px;
}

.bl-offices-title {
  margin: 0;
  font-size: 19px;
  font-weight: 700;
  color: #ffffff;
}

.bl-offices-close {
  background: #222222;
  border: 1px solid #333333;
  color: #aaaaaa;
  font-size: 22px;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s ease;
  line-height: 1;
}

.bl-offices-close:hover {
  background: #ffffff;
  color: #000000;
  border-color: #ffffff;
}

/* Modal Body: Office Cards */
.bl-offices-modal-body {
  padding: 24px;
}

.bl-offices-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

@media (max-width: 767px) {
  .bl-offices-grid {
    grid-template-columns: 1fr;
    gap: 16px;
  }
}

.bl-office-card {
  background: #1c1c1c;
  border: 1px solid #2c2c2c;
  border-radius: 16px;
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 14px;
  transition: border-color 0.2s ease, background 0.2s ease;
}

.bl-office-card:hover {
  border-color: #444444;
  background: #202020;
}

.bl-office-card__top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
}

.bl-office-tag {
  background: #000000;
  border: 1px solid #444444;
  color: #ffffff;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.05em;
  padding: 3px 10px;
  border-radius: 6px;
}

.bl-office-region {
  font-size: 12px;
  color: #888888;
  font-weight: 500;
}

.bl-office-name {
  margin: 0;
  font-size: 15.5px;
  font-weight: 700;
  color: #ffffff;
  line-height: 1.4;
}

.bl-office-info-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
  padding-top: 4px;
  border-top: 1px solid #282828;
}

.bl-office-info-item {
  display: flex;
  align-items: flex-start;
  gap: 10px;
}

.bl-office-info-icon {
  width: 28px;
  height: 28px;
  border-radius: 8px;
  background: #111111;
  border: 1px solid #2a2a2a;
  color: #888888;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  margin-top: 1px;
}

.bl-office-info-text {
  flex: 1;
  min-width: 0;
}

.bl-office-info-text strong {
  display: block;
  font-size: 11.5px;
  color: #777777;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 2px;
}

.bl-office-info-text p {
  margin: 0;
  font-size: 13.5px;
  color: #dddddd;
  line-height: 1.45;
}

.bl-office-map-link,
.bl-office-contact-link {
  display: inline-block;
  margin-top: 4px;
  font-size: 12.5px;
  color: #ffffff !important;
  text-decoration: underline !important;
  text-underline-offset: 3px;
  font-weight: 600;
  transition: opacity 0.2s ease;
}

.bl-office-map-link:hover,
.bl-office-contact-link:hover {
  opacity: 0.75;
}

/* Modal Footer CTA */
.bl-offices-modal-footer {
  background: #181818;
  border-top: 1px solid #2a2a2a;
  padding: 18px 24px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  flex-wrap: wrap;
}

.bl-offices-footer-text strong {
  display: block;
  font-size: 15px;
  color: #ffffff;
  margin-bottom: 2px;
}

.bl-offices-footer-text span {
  font-size: 13px;
  color: #888888;
}

.bl-offices-hotline-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #ffffff;
  color: #000000 !important;
  border: 1px solid #ffffff;
  border-radius: 9999px;
  padding: 12px 24px;
  font-size: 14px;
  font-weight: 700;
  letter-spacing: 0.5px;
  text-decoration: none !important;
  cursor: pointer;
  transition: all 0.2s ease;
  box-shadow: 0 4px 14px rgba(255, 255, 255, 0.15);
}

.bl-offices-hotline-btn:hover {
  background: #e0e0e0;
  border-color: #e0e0e0;
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(255, 255, 255, 0.25);
}

@media (max-width: 580px) {
  .bl-floating-contact {
    bottom: 20px;
    right: 20px;
  }
  .bl-contact-popup {
    width: 290px;
    bottom: 68px;
  }
  .bl-offices-modal-footer {
    flex-direction: column;
    text-align: center;
    gap: 14px;
  }
  .bl-offices-hotline-btn {
    width: 100%;
    justify-content: center;
  }
}
</style>

<script>
/* Global JavaScript handlers for Floating Contact & Offices Modal */
function blToggleContactPopup() {
  var wrap = document.getElementById('blFloatingContact');
  if (!wrap) return;
  wrap.classList.toggle('bl-active');
}

function blCloseContactPopup() {
  var wrap = document.getElementById('blFloatingContact');
  if (!wrap) return;
  wrap.classList.remove('bl-active');
}

function blOpenOfficesModal() {
  blCloseContactPopup();
  var modal = document.getElementById('blOfficesModal');
  if (!modal) return;
  modal.classList.add('bl-modal--active');
  document.body.style.overflow = 'hidden';
}

function blCloseOfficesModal() {
  var modal = document.getElementById('blOfficesModal');
  if (!modal) return;
  modal.classList.remove('bl-modal--active');
  document.body.style.overflow = '';
}

function blCloseOfficesModalOnBackdrop(e) {
  if (e.target && e.target.id === 'blOfficesModal') {
    blCloseOfficesModal();
  }
}

// Close when clicking outside popup
document.addEventListener('click', function(e) {
  var wrap = document.getElementById('blFloatingContact');
  if (!wrap) return;
  if (!wrap.contains(e.target)) {
    wrap.classList.remove('bl-active');
  }
});

// Escape key to close
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    blCloseContactPopup();
    blCloseOfficesModal();
  }
});
</script>
