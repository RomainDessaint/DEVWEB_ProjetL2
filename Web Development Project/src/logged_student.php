<?php
include("../includes/display.inc.php");
include("../includes/util.inc.php");

session_start();
if(($_SESSION['logType']) != 1) {
     header('location: login_student.php');
     exit();
}

echo display_header("Espace Etudiants", "../styles/style_logpages.css");
?>

<section>
     <?php
     echo display_titleLog("Espace Etudiants");
     ?>

     <article>
          <?php
              echo formUpload();
          ?>
              <script type="text/javascript">
              var rules = {a:"àáâãäå",
                           A:"ÀÁÂ",
                           e:"èéêë",
                           E:"ÈÉÊË",
                           i:"ìíîï",
                           I:"ÌÍÎÏ",
                           o:"òóôõöø",
                           O:"ÒÓÔÕÖØ",
                           u:"ùúûü",
                           U:"ÙÚÛÜ",
                           y:"ÿ",
                           c: "ç",
                           C:"Ç",
                           n:"ñ",
                           N:"Ñ"
             };
              function  getJSONKey(key){
                  for (acc in rules){
                      if (rules[acc].indexOf(key)>-1){return acc}
                  }
              }

              function replaceSpec(Texte){
                  regstring=""
                  for (acc in rules){
                    regstring+=rules[acc]
                  }
                  reg=new RegExp("["+regstring+"]","g" )
                     return Texte.replace(reg,function(t){ return getJSONKey(t) });
             }

              const realFileBtn = document.getElementById("real-file");
              const customBtn = document.getElementById("custom-button");
              const customTxt = document.getElementById("custom-text");

              customBtn.addEventListener("click", function(){
                  realFileBtn.click();
              });

              realFileBtn.addEventListener("change", function(){
                  if (realFileBtn.value) {
                      var TestTexte = realFileBtn.value;
                      customTxt.innerHTML = replaceSpec(TestTexte).match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
                  } else{
                      customTxt.innerHTML = "Aucune image choisie.";
                  }
              });
              </script>
          <?php
              if (isset($_POST['submit'])) {
              echo upload();
          }
          ?>
     </article>
</section>

<?php
echo display_footer("back");
?>
