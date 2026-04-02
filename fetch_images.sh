#!/bin/bash
declare -A destinations=(
    ["patagonia.jpg"]="Patagonia"
    ["banff.jpg"]="Banff_National_Park"
    ["queenstown.jpg"]="Queenstown,_New_Zealand"
    ["faroe.jpg"]="Faroe_Islands"
    ["kyoto.jpg"]="Kyoto"
    ["machu-picchu.jpg"]="Machu_Picchu"
    ["fez.jpg"]="Fez,_Morocco"
    ["valletta.jpg"]="Valletta"
    ["bangkok.jpg"]="Bangkok"
    ["bologna.jpg"]="Bologna"
    ["oaxaca.jpg"]="Oaxaca_City"
    ["penang.jpg"]="Penang_Island"
)

mkdir -p public/images/destinations

for file in "${!destinations[@]}"; do
    title="${destinations[$file]}"
    echo "Fetching image for $title..."
    # Get thumbnail source URL from Wikipedia API
    img_url=$(curl -s -L "https://en.wikipedia.org/w/api.php?action=query&titles=${title}&prop=pageimages&format=json&pithumbsize=1200" | grep -o '"source":"[^"]*"' | head -n 1 | cut -d '"' -f 4)
    if [ -n "$img_url" ] && [ "$img_url" != "null" ]; then
        echo "Found URL: $img_url"
        curl -s -L "$img_url" -o "public/images/destinations/$file"
    else
        echo "No image found for $title"
    fi
done

# Set default destination to patagonia or banff if exist
cp public/images/destinations/banff.jpg public/images/default-destination.jpg
