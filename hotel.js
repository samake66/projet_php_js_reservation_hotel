/*var ville = document.getElementById('specificSizeInputName').value;

document.getElementById('myForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêche l'envoi du formulaire et le rechargement de la page
    console.log('ville:', ville);
  });

if (ville.length === 0) {
    console.log('entrez une ville ou code postal s il vous plait!');
    return false;
  }

  document.getElementById('ville').addEventListener('input', function() {
    console.log('Current Value:', this.value);
  });
*/

  document.getElementById('hotel1').textContent = 'PALACE';
  const hotel2 = document.getElementById('hotel2');
  hotel2.textContent = 'NOVOTEL';
  const hotel3 = document.getElementById('hotel3');
  hotel3.textContent = 'EDEN';

  const p_hotel1 = document.getElementById('p_hotel1');
  p_hotel1.textContent = 'Un hotel qui offre un service hébergement payant en chambres meublées à une clientèle de passage.';
  const p_hotel2 = document.getElementById('p_hotel2');
  p_hotel2.textContent = 'Les cinq étoiles sont logiquement les établissements qui doivent remplir le plus de critères, classés en trois catégories.';
  const p_hotel3 = document.getElementById('p_hotel3');
  p_hotel3.textContent = 'la qualité est bien sûr l’affaire de tous, du directeur jusqu’au plus jeune apprenti, en passant par le plongeur et la femme de chambre.';


document.getElementById('myForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêche l'envoi du formulaire et le rechargement de la page
    console.log('Username:', username);
  });

