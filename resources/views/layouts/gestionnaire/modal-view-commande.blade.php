<div class="modal fade" id="viewOrderModal" tabindex="-1" aria-labelledby="viewOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewOrderModalLabel">Détails de la Commande #ORD-2023-001</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6>Informations Client</h6>
                        <p><strong>Nom:</strong> Jean Dupont</p>
                        <p><strong>Email:</strong> jean.dupont@example.com</p>
                        <p><strong>Téléphone:</strong> 06 12 34 56 78</p>
                        <p><strong>Adresse:</strong> 123 Rue de Paris, 75001 Paris</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Informations Commande</h6>
                        <p><strong>Date:</strong> 15/05/2023 14:30</p>
                        <p><strong>Statut:</strong> <span class="badge bg-success">Livré</span></p>
                        <p><strong>Paiement:</strong> Carte bancaire</p>
                        <p><strong>Total:</strong> 45.90 €</p>
                    </div>
                </div>
                <h6>Articles commandés</h6>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Burger Classique</td>
                        <td>2</td>
                        <td>12.50 €</td>
                        <td>25.00 €</td>
                    </tr>
                    <tr>
                        <td>Frites Maison</td>
                        <td>2</td>
                        <td>4.50 €</td>
                        <td>9.00 €</td>
                    </tr>
                    <tr>
                        <td>Coca-Cola</td>
                        <td>3</td>
                        <td>3.30 €</td>
                        <td>9.90 €</td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Sous-total:</strong></td>
                        <td>43.90 €</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Frais de livraison:</strong></td>
                        <td>2.00 €</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                        <td><strong>45.90 €</strong></td>
                    </tr>
                    </tfoot>
                </table>
                <h6>Historique de la commande</h6>
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="badge bg-primary me-2">15/05/2023 14:30</span>
                        Commande reçue
                    </li>
                    <li class="list-group-item">
                        <span class="badge bg-warning text-dark me-2">15/05/2023 14:35</span>
                        En préparation
                    </li>
                    <li class="list-group-item">
                        <span class="badge bg-info me-2">15/05/2023 14:50</span>
                        En livraison
                    </li>
                    <li class="list-group-item">
                        <span class="badge bg-success me-2">15/05/2023 15:15</span>
                        Livrée
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Imprimer</button>
            </div>
        </div>
    </div>
</div>
