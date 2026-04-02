#!/bin/bash
declare -A destinations=(
    ["patagonia.jpg"]="Torres_del_Paine_National_Park"
    ["banff.jpg"]="Banff_National_Park"
    ["queenstown.jpg"]="Queenstown,_New_Zealand"
    ["faroe.jpg"]="Faroe_Islands_landscapes"
    ["kyoto.jpg"]="Kyoto"
    ["machu-picchu.jpg"]="Machu_Picchu"
    ["fez.jpg"]="Fes_el_Bali"
    ["valletta.jpg"]="Valletta"
    ["bangkok.jpg"]="Bangkok"
    ["bologna.jpg"]="Bologna"
    ["oaxaca.jpg"]="Oaxaca_City"
    ["penang.jpg"]="George_Town,_Penang"
)

mkdir -p public/images/destinations

for file in "${!destinations[@]}"; do
    title="${destinations[$file]}"
    echo "Fetching image for $title..."
    # Attempt to find the first image in the page that is not a map
    # We'll use the 'images' property and filter out maps/icons
    # Then get the thumbnail source for that image
    image_list=$(curl -s "https://en.wikipedia.org/w/api.php?action=query&titles=${title}&prop=images&format=json" | grep -o 'File:[^"]*' | grep -viE "map|flag|logo|icon|button|shield|svg" | head -n 5)
    
    img_url=""
    for img_name in $image_list; do
        encoded_img=$(echo "$img_name" | sed 's/ /_/g')
        source_url=$(curl -s "https://en.wikipedia.org/w/api.php?action=query&titles=${encoded_img}&prop=imageinfo&iiprop=url&iiurlwidth=1200&format=json" | grep -o '"thumburl":"[^"]*"' | head -n 1 | cut -d '"' -f 4)
        if [ -n "$source_url" ]; then
            img_url="$source_url"
            break
        fi
    done
    
    if [ -n "$img_url" ]; then
        echo "Found image URL: $img_url"
        curl -s -L "$img_url" -o "public/images/destinations/$file"
    else
        # Fallback to simple pageimage
        img_url=$(curl -s -L "https://en.wikipedia.org/w/api.php?action=query&titles=${title}&prop=pageimages&pithumbsize=1200&format=json" | grep -o '"source":"[^"]*"' | head -n 1 | cut -d '"' -f 4)
        if [ -n "$img_url" ] && [ "$img_url" != "null" ]; then
            echo "Fallback image URL: $img_url"
            curl -s -L "$img_url" -o "public/images/destinations/$file"
        else
            echo "No image found for $title"
        fi
    fi
done
