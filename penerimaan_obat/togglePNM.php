<script>
function toggleDivPNM(div1Id, div2Id, div3Id,div4Id,toggleDivs) {
  var div1 = document.getElementById(div1Id);
  var div2 = document.getElementById(div2Id);
  var div3 = document.getElementById(div3Id);
  var div4 = document.getElementById(div4Id);
  var toggleDivss = document.getElementById(toggleDivs);





  if (div1.style.display === "none") {
    div1.style.display = "block";
    div2.style.display = "block";
    div3.style.display = "block";
    div4.style.display = "block";
    toggleDivss.style.backgroundColor = "gray";
    toggleDivss.style.borderColor = "skyblue";




  } else {
    div1.style.display = "none";
    div2.style.display = "none";
    div3.style.display = "none";
    div4.style.display = "none";
    toggleDivss.style.backgroundColor = "skyblue";


  }
}
</script>