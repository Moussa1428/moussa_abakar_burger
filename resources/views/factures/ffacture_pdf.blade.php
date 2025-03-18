<h1>Facture N0 {{ $commande->id }}</h1>
<p>Date : {{ $commande->date_commande }}</p>
<p>Client : {{ $commande->utilisateur->name }}</p>

<table>
    <thead>
    <tr>
        <th>Produit</th>
        <th>Quantité</th>
        <th>Prix unitaire</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($commande->details as $detail)
        <tr>
            <td>{{ $detail->produit->nom }}</td>
            <td>{{ $detail->quantite }}</td>
            <td>{{ $detail->prix_unitaire }}</td>
            <td>{{ $detail->quantite * $detail->prix_unitaire }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<p><strong>Total : {{ $commande->montant_total }} fcfa</strong></p>
