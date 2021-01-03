//DARK MODE

/* DECLARATIONS */

let darkModeState = localStorage.getItem('darkModeState'); 

const darkModeToggle = document.querySelector('#dark-mode-toggle');

/**
 * 1. Adds the class to the body of the document.
 * 2. Sets darkModeState in localStorage to enabled
 */

function enableDarkMode() {

  document.body.classList.remove('light-mode');
  // Adds the class to the body of the document.
  document.body.classList.add('dark-mode');
  // Sets darkModeState in localStorage to enabled
  localStorage.setItem('darkModeState', 'enabled');
}

/**
 * 1. Removes the class to the body of the document.
 * 2. Sets darkModeState in localStorage to disabled
 */
function disableDarkMode() {

  document.body.classList.remove('dark-mode');
  document.body.classList.add('light-mode');
  localStorage.setItem('darkModeState', 'disabled');
}
 
/* ACTIVE PART */

// enable when the page loads
// based on user system preference
// ???? already in css I guess
// or if the user already visited and set darkModeState to enabled
if (darkModeState === 'enabled') {
  enableDarkMode();
}

// When someone clicks the button
darkModeToggle.addEventListener('click', () => {
    // get their darkModeState setting
    darkModeState = localStorage.getItem('darkModeState');

    // if it not current enabled, enable it
    if (darkModeState !== 'enabled') {
      enableDarkMode();

      // if it has been enabled, turn it off  
    } else {
      disableDarkMode();
    }
  });

// DARK MODE END
