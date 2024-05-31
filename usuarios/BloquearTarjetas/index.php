<?php  include("../../templates/headerUsuarios.php"); ?>
<style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
        }
        input:checked + .slider {
            background-color: #2196F3;
        }
        input:checked + .slider:before {
            transform: translateX(26px);
        }
        .slider.round {
            border-radius: 34px;
        }
        .slider.round:before {
            border-radius: 50%;
        }
        .center-button {
            text-align: center;
        }
    </style>


<div class="card">


    <div class="card-header d-flex bg-info">        
        <h2 class="fs-3">Bloquear Tarjeta</h2>
        
    </div>
    <div>
            
                <div class="card-body">   

                    <p style="text-align:center"><b>Bloqueo temporal tarjeta</b></p>

                    <div class="text-center">
                        <img src="https://www.bbva.com/wp-content/uploads/2020/08/BBVA-activar-tarjeta.gif"  style="width: 400px; height: 250px;">
                    </div>

                <br>
                
                <div class="center-button">
                    <label class="switch">
                        <input type="checkbox" id="toggleSwitch" onclick="toggleStatus()">
                        <span class="slider round"></span>
                    </label>
                </div>

                    <script>
                        function toggleStatus() {
                            let toggleSwitch = document.getElementById("toggleSwitch");
                            if (toggleSwitch.checked) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Tarjeta Bloqueada Temporalmente',
                                    html: 'Realizaste el bloqueo temporal de tu tarjeta exitosamente, no podrés utilizarla para consumos.',
                                    showConfirmButton: false,
                                    timer: 7000
                                });
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Tarjeta Desbloqueada',
                                    html: 'Desactivaste el bloqueo temporal, puedes seguir con tus gestiones.',
                                    showConfirmButton: false,
                                    timer: 7000
                                });
                            }
                        }
                    </script>               

                </div>
          


        
    </div>
</div>

<?php  include("../../templates/footer.php"); ?>