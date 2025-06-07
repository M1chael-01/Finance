<head>
    <link rel="stylesheet" href="./frontend/styles/pages/information.css">
</head>
<body>
  <div id="toast" class="toast">
    <div id="toast-header" class="toast-header">
      <strong id="toast-title" class="toast-title">UPOZORNĚNÍ</strong>
        <span onclick="closeToast()" class="close" aria-hidden="true">&times;</span>
      </button>
    </div>
    <div id="toast-body" class="toast-body">
      <p>Takový uživetel nexistuje</p>
      <button class="toast-btn" onclick="showMessage()">OK</button>
    </div>
  </div>
  <script>
    function showToast() {
      const toast = document.getElementById('toast');
      toast.classList.add('show');
      setTimeout(() => {
        toast.classList.remove('show');
      }, 5000); 
    }

    function closeToast() {
      const toast = document.getElementById('toast');
      toast.classList.remove('show');
    }

  

   
  </script>

</body>
</html>
