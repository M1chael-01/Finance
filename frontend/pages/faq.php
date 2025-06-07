<?php require "./frontend/pages/header.php"; ?>
<link rel="stylesheet" href="./frontend/styles/pages/faq.css">

<div class="faq">
  <div class="responsive-container-block bigContainer">
    <div class="responsive-container-block Container">
      <p id="heading" class="text-blk heading" style="margin-bottom: 65px;">
        Často kladené otázky
      </p>
      <div class="responsive-container-block allCardContainer">
        <div class="responsive-cell-block wk-desk-6 wk-ipadp-12 wk-tab-12 wk-mobile-12">
          <div class="card">
           <p class="text-blk cardHeading">
  Je to zadarmo?
</p>
<p class="text-blk cardSubHeading">
Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia impedit similique eius debitis vitae corporis perspiciatis magnam amet aut neque?
Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia 
</p>

            <a class="readMore" href="javascript:void(0);" onclick="showToast('Je to zadarmo?', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia impedit similique eius debitis vitae corporis perspiciatis magnam amet aut neque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia')">
              Přečíst více
            </a>
            <div class="lineDivider"></div>
          </div>
        </div>
        <div class="responsive-cell-block wk-desk-6 wk-ipadp-12 wk-tab-12 wk-mobile-12">
          <div class="card">
            <p class="text-blk cardHeading">
              Je to bezpečné?
            </p>
            <p class="text-blk cardSubHeading">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia impedit similique eius debitis vitae corporis perspiciatis magnam amet aut neque?
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia 
</p>

            <a class="readMore" href="javascript:void(0);" onclick="showToast('Je to bezpečné?', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia impedit similique eius debitis vitae corporis perspiciatis magnam amet aut neque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia')">
              Přečíst více
            </a>
            <div class="lineDivider"></div>
          </div>
        </div>
        <div class="responsive-cell-block wk-desk-6 wk-ipadp-12 wk-tab-12 wk-mobile-12">
          <div class="card">
          <p class="text-blk cardHeading">
  Kolik účtů může srávce spravovat?
</p>
<p class="text-blk cardSubHeading">
Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia impedit similique eius debitis vitae corporis perspiciatis magnam amet aut neque?
Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia
</p>

            <a class="readMore" href="javascript:void(0);" onclick="showToast('Kolik účtů může právce spravovat?', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia impedit similique eius debitis vitae corporis perspiciatis magnam amet aut neque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia')">
              Přečíst více
            </a>
            <div class="lineDivider"></div>
          </div>
        </div>
        <div class="responsive-cell-block wk-desk-6 wk-ipadp-12 wk-tab-12 wk-mobile-12">
          <div class="card">
            <p class="text-blk cardHeading">
              Je tento systém složitý?
            </p>
            <p class="text-blk cardSubHeading">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia impedit similique eius debitis vitae corporis perspiciatis magnam amet aut neque?
Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia
            </p>
            <a class="readMore" href="javascript:void(0);" onclick="showToast('Je tento systém složitý?', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia impedit similique eius debitis vitae corporis perspiciatis magnam amet aut neque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia')">
              Přečíst více
            </a>
            <div class="lineDivider"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="toast" class="toast">
  <div id="toast-header" class="toast-header">
    <strong id="toast-title" class="mr-auto">FAQ Detail</strong>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" onclick="closeToast()">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div id="toast-body" class="toast-body">
    <p></p>
  </div>
</div>

<?php require "./frontend/pages/footer.php"; ?>

<script>
  function showToast(title, message) {
    // Nastavení obsahu toasu
    document.getElementById("toast-title").textContent = title;
    document.getElementById("toast-body").innerHTML = `<p>${message}</p>`;
  
    // Zobrazení toasu a přidání animace
    let toast = document.getElementById("toast");
    toast.style.display = "block";
    toast.classList.add('show');
    
    // Automatické zavření toasu po 5 sekundách
    setTimeout(closeToast, 5000);
  }
  
  function closeToast() {
    let toast = document.getElementById("toast");
    toast.classList.remove('show');
    setTimeout(() => {
      toast.style.display = "none";
    }, 500); // Po animaci, aby toas zmizel
  }
</script>
