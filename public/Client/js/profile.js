// Charger les informations du profil au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    loadUserProfile();
    loadUserAddresses();
    loadUserPreferences();
});

// Charger les informations du profil
function loadUserProfile() {
    // Dans un cas réel, ces données viendraient d'une API
    const userData = {
        prenom: localStorage.getItem('userPrenom') || '',
        nom: localStorage.getItem('userNom') || '',
        email: localStorage.getItem('userEmail') || '',
        telephone: localStorage.getItem('userTelephone') || ''
    };

    // Remplir les champs du formulaire
    document.getElementById('prenom').value = userData.prenom;
    document.getElementById('nom').value = userData.nom;
    document.getElementById('email').value = userData.email;
    document.getElementById('telephone').value = userData.telephone;

    // Mettre à jour l'en-tête du profil
    document.getElementById('userName').textContent = `${userData.prenom} ${userData.nom}`;
    document.getElementById('userEmail').textContent = userData.email;
}

// Mettre à jour le profil
function updateProfile(event) {
    event.preventDefault();

    const userData = {
        prenom: document.getElementById('prenom').value,
        nom: document.getElementById('nom').value,
        email: document.getElementById('email').value,
        telephone: document.getElementById('telephone').value
    };

    // Simuler une mise à jour API
    localStorage.setItem('userPrenom', userData.prenom);
    localStorage.setItem('userNom', userData.nom);
    localStorage.setItem('userEmail', userData.email);
    localStorage.setItem('userTelephone', userData.telephone);
    localStorage.setItem('userName', `${userData.prenom} ${userData.nom}`);

    // Mettre à jour l'affichage
    loadUserProfile();

    // Afficher un message de succès
    alert('Profil mis à jour avec succès !');
    return false;
}

// Mettre à jour le mot de passe
function updatePassword(event) {
    event.preventDefault();

    const currentPassword = document.getElementById('currentPassword').value;
    const newPassword = document.getElementById('newPassword').value;
    const confirmNewPassword = document.getElementById('confirmNewPassword').value;

    // Vérifier que les nouveaux mots de passe correspondent
    if (newPassword !== confirmNewPassword) {
        alert('Les nouveaux mots de passe ne correspondent pas !');
        return false;
    }

    // Simuler une mise à jour API
    alert('Mot de passe mis à jour avec succès !');

    // Réinitialiser le formulaire
    event.target.reset();
    return false;
}

// Charger les adresses de l'utilisateur
function loadUserAddresses() {
    const addressList = document.getElementById('addressList');
    const addresses = JSON.parse(localStorage.getItem('userAddresses')) || [];

    addressList.innerHTML = '';

    if (addresses.length === 0) {
        addressList.innerHTML = '<p class="text-muted">Aucune adresse enregistrée</p>';
        return;
    }

    addresses.forEach((address, index) => {
        const addressCard = document.createElement('div');
        addressCard.className = 'card mb-3';
        addressCard.innerHTML = `
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="card-title">${address.nom}</h6>
                        <p class="card-text">${address.rue}<br>${address.codePostal} ${address.ville}</p>
                    </div>
                    <div>
                        <button class="btn btn-outline-danger btn-sm" onclick="deleteAddress(${index})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        addressList.appendChild(addressCard);
    });
}

// Ajouter une nouvelle adresse
function showAddAddressModal() {
    // Dans un cas réel, vous auriez un modal Bootstrap ici
    const nom = prompt('Nom de l\'adresse (ex: Domicile, Bureau)');
    if (!nom) return;

    const rue = prompt('Rue');
    if (!rue) return;

    const codePostal = prompt('Code postal');
    if (!codePostal) return;

    const ville = prompt('Ville');
    if (!ville) return;

    const addresses = JSON.parse(localStorage.getItem('userAddresses')) || [];
    addresses.push({ nom, rue, codePostal, ville });
    localStorage.setItem('userAddresses', JSON.stringify(addresses));

    loadUserAddresses();
}

// Supprimer une adresse
function deleteAddress(index) {
    if (!confirm('Êtes-vous sûr de vouloir supprimer cette adresse ?')) {
        return;
    }

    const addresses = JSON.parse(localStorage.getItem('userAddresses')) || [];
    addresses.splice(index, 1);
    localStorage.setItem('userAddresses', JSON.stringify(addresses));

    loadUserAddresses();
}

// Charger les préférences utilisateur
function loadUserPreferences() {
    const preferences = JSON.parse(localStorage.getItem('userPreferences')) || {
        langue: 'fr',
        notifications: true,
        newsletter: false
    };

    document.getElementById('langue').value = preferences.langue;
    document.getElementById('notifications').checked = preferences.notifications;
    document.getElementById('newsletter').checked = preferences.newsletter;
}

// Mettre à jour les préférences
function updatePreferences(event) {
    event.preventDefault();

    const preferences = {
        langue: document.getElementById('langue').value,
        notifications: document.getElementById('notifications').checked,
        newsletter: document.getElementById('newsletter').checked
    };

    localStorage.setItem('userPreferences', JSON.stringify(preferences));
    alert('Préférences mises à jour avec succès !');
    return false;
}
