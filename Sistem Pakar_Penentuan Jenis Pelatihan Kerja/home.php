<!-- home.php -->
<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Fira+Mono&display=swap');

  :root {
    --navbar-height: 60px;
    --logo-dark: #003366;
    --logo-light: #cce6f2;
  }

  /* Wrapper full-screen */
  .home-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: calc(100vh - var(--navbar-height));
    padding: 20px;
    background: #f7f9fc;
  }

  /* Perbesar panel: gunakan 90% layar dengan max 1000px */
  .home-panel {
    width: 90%;
    max-width: 1000px;  
    background: #fff;
    border-radius: 2rem;
    box-shadow: 0 8px 36px rgba(0,0,0,0.12);
    overflow: hidden;
  }

  .home-body {
    padding: 48px 40px 60px 40px;
    text-align: center;
  }

  /* Gambar lebih besar */
  #header-img {
    width: 100px;
    max-width: 85vw;
    border-radius: 28px;
    margin-bottom: 24px;
    opacity: 0;
    transform: translateY(32px) scale(.97);
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
  }

  /* Judul lebih besar */
  #judul-typer {
    font-family: 'Fira Mono', monospace;
    font-weight: 700;
    font-size: 3rem;
    min-height: 60px;
    background: linear-gradient(90deg, var(--logo-dark) 60%, var(--logo-light) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    display: inline-block;
    margin-bottom: 16px;
    letter-spacing: 0.05em;
    text-shadow: 0 2px 12px rgba(0,0,0,0.1);
    border-bottom: 3px solid var(--logo-light);
    animation: shimmer 2.5s infinite linear;
  }

  @keyframes shimmer {
    0%   { background-position: -300px 0; }
    100% { background-position: 600px 0; }
  }

  /* Deskripsi lebih lega */
  #deskripsi-typer {
    display: inline-block;
    font-family: 'Fira Mono', monospace;
    font-size: 1.4rem;
    color: var(--logo-dark);
    min-height: 120px;
    text-align: center;
    background: var(--logo-light);
    border-left: 4px solid var(--logo-dark);
    padding: 20px 24px;
    border-radius: 1.2em;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    animation: fadeInUp .8s .5s backwards, blink-caret .8s infinite;
  }

  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: none; }
  }

  @keyframes blink-caret {
    0%,100% { border-color: var(--logo-dark); }
    50%     { border-color: transparent; }
  }
</style>

<div class="home-wrapper">
  <div class="home-panel">
    <div class="home-body">
      <img id="header-img" src="assets/images/KEMNAKERRI.png" alt="Logo Kemnaker">
      <h1 id="judul-typer"></h1>
      <div style="margin-top:32px;">
        <span id="deskripsi-typer"></span>
      </div>
    </div>
  </div>
</div>

<script>
  // Fade-in gambar
  window.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
      const img = document.getElementById('header-img');
      img.style.transition = 'all 1.2s cubic-bezier(.7,.1,.3,1)';
      img.style.opacity = '1';
      img.style.transform = 'translateY(0) scale(1)';
    }, 300);
  });

  // Typewriter
  const judul = "Kementerian Ketenagakerjaan Republik Indonesia";
  const deskripsi = `Sistem Pakar Penentuan Jenis Pelatihan Kerja yang Sesuai dengan Profil Pencari Kerja\nMenggunakan Metode Forward Chaining pada Kementerian Ketenagakerjaan RI`;
  let i = 0, j = 0, speed = 55;

  function typeTitle(){
    if(i < judul.length){
      document.getElementById("judul-typer").textContent += judul[i++];
      setTimeout(typeTitle, speed);
    }
  }
  function typeDesc(){
    if(j < deskripsi.length){
      document.getElementById("deskripsi-typer").textContent += deskripsi[j++];
      let delay = deskripsi[j-1]==="\n" ? speed*8 : speed;
      setTimeout(typeDesc, delay);
    }
  }
  window.onload = () => {
    setTimeout(typeTitle, 300);
    setTimeout(typeDesc, 900);
  };
</script>
