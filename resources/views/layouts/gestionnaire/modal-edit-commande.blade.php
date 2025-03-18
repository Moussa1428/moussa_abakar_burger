<div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOrderModalLabel">Modifier la Commande #ORD-2023-001</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Informations Client</h6>
                            <div class="mb-3">
                                <label for="clientName" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="clientName" value="Jean Dupont">
                            </div>
                            <div class="mb-3">
                                <label for="clientEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="clientEmail" value="jean.dupont@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="clientPhone" class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" id="clientPhone" value="06 12 34 56 78">
                            </div>
                            <div class="mb-3">
                                <label for="clientAddress" class="form-label">Adresse</label>
                                <textarea class="form-control" id="clientAddress" rows="2">123 Rue de Paris, 75001 Paris</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Informations Commande</h6>
                            <div class="mb-3">
                                <label for="orderDate" class="form-label">Date</label>
                                <input type="datetime-local" class="form-control" id="orderDate" value="2023-05-15T14:30">
                            </div>
                            <div class="mb-3">
                                <label for="orderStatus" class="form-label">Statut</label>
                                <select class="form-select" id="orderStatus">
                                    <option value="new">Nouveau</option>
                                    <option value="preparing">En préparation</option>
                                    <option value="delivery">En livraison</option>
                                    <option value="completed" selected>Livré</option>
                                    <option value="cancelled">Annulé</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="paymentMethod" class="form-label">Méthode de paiement</label>
                                <select class="form-select" id="paymentMethod">
                                    <option value="card" selected>Carte bancaire</option>
                                    <option value="cash">Espèces</option>
                                    <option value="paypal">PayPal</option>
                                </select>
                            </div>
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
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <select class="form-select">
                                    <option selected>Burger Classique</option>
                                    <option>Burger Cheese</option>
                                    <option>Burger Végétarien</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control" value="2" min="1">
                            </td>
                            <td>12.50 €</td>
                            <td>25.00 €</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select class="form-select">
                                    <option>Burger Classique</option>
                                    <option>Burger Cheese</option>
                                    <option>Burger Végétarien</option>
                                    <option selected>Frites Maison</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control" value="2" min="1">
                            </td>
                            <td>4.50 €</td>
                            <td>9.00 €</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select class="form-select">
                                    <option>Burger Classique</option>
                                    <option>Burger Cheese</option>
                                    <option>Burger Végétarien</option>
                                    <option>Frites Maison</option>
                                    <option selected>Coca-Cola</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control" value="3" min="1">
                            </td>
                            <td>3.30 €</td>
                            <td>9.90 €</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5">
                                <button type="button" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Ajouter un article</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Sous-total:</strong></td>
                            <td>43.90 €</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Frais de livraison:</strong></td>
                            <td>
                                <input type="number" class="form-control" value="2.00" step="0.10">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td><strong>45.90 €</strong></td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">Enregistrer les modifications</button>
            </div>
        </div>
    </div>
</div>
