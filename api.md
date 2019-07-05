POSletics API

# <span style="color:grey">GET</span> */users*

Liefert alle Benutzer zurück

Als Antwort bekommt man ein Array mit allen Benutzern zurück:
```json
[
  {
    "id": 1,
    "name": "Klaus",
    "route": [ 1, 2, 3 ]
  },
  {
    ...
  }
]
```

# <span style="color:grey">GET</span> */pos*

Liefert alle verfügbaren POS samt Hashtags zurück

Als Antwort bekommt man alle verfügbaren POS samt Hashtags zurück.

```json
[
  {
    "id": 1,
    "lat": "51.481846",
    "lng": "7.216236",
    "upvotes": 0,
    "user_id": 4,
    "hashtags": []
  },
  {
    "id": 2,
    "lat": "51.481846",
    "lng": "7.216236",
    "upvotes": 0,
    "user_id": 4,
    "hashtags": [
      {
        "id": 1,
        "name": "#test",
        "upvotes": 0
      }
    ]
  }
]
```

# <span style="color:grey">POST</span> */pos*

Erzeugt einen neuen POS.

Dabei werden folgende Werte als JSON Body erwartet:
```json
{
  "lat"       // Pflicht, Zahl, Braitengrad
  "lng"       // Pflicht, Zahl, Längengrad
  "user_id"   // Pflicht, Zahl, eine gültige Benutzer ID
  "hashtags"  // Optional, Array mit Hashtag Objekten
}
```

Ein Hashtag hat die Struktur:
```json
{
  "name"
  "upvotes"
}
```

Beispiel:
```json
{
  "lat": 123,
  "lng": 123,
  "user_id": 1,
  "hashtags": [
    { "name": "#WOW" },
    { "name": "#Hashtag", "upvotes": 2 }
  ]
}
```

# <span style="color:grey">PATCH</span> */pos/*{id}

Bearbeitet einen bestehenden POS

Dabei werden folgende Werte als JSON Body erwartet:
```json
{
  "lat"       // Optional, Braitengrad
  "lng"       // Optional, Längengrad
  "hashtags"  // Array mit Hashtag Objekten (siehe POST /pos)
}
```

# <span style="color:grey">PATCH</span> */hashtags/*{id}

Bearbeitet einen bestehenden Hashtag

Dabei werden folgende Werte als JSON Body erwartet:
```json
{
  "name"       // Optional, Braitengrad
  "upvotes"    // Optional, Längengrad
}
```

# <span style="color:grey">GET</span> */route*

Liefert die zuletzt erstellte Route von einem Benutzer

Dabei werden folgende Werte als JSON Body erwartet:
```json
{
  "user_id"     // Pflicht, ID eines Benutzers
}
```

Alternativ kann auch die ID als Querystring übergeben werden. Z.B:

```
/route?user_id=1
```

Als Antwort bekommt man ein Array mit den IDs der jeweiligen POS der Route. Z.B:
```json
[1, 6, 9, 4]
```

# <span style="color:grey">POST</span> */route*

Speichert eine Route zu einem bestimmten Benutzer

Dabei werden folgende Werte als JSON Body erwartet:
```json
{
  "user_id"     // Pflicht, ID eines Benutzers
  "route"       // Pflicht, Array mit IDs von POS
}
```

Beispiel:
```json
{
  "user_id": 1,
  "route": [1, 2, 3, 4]
}
```

