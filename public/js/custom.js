function count() {
    let input = document.getElementById('textvalue');
    let text = input.value.trim(); // Trim whitespace from both ends
    let textCount = text.length;
    
     
      if (textCount>50) {
          input.style.color="disable";
          alert("please Enter The Minimum 50 Charecter")
          
      } else {
          input.style.color="#1DA1F2";
      }
  
    
    
    document.getElementById('textCount').textContent = textCount;
    
  }