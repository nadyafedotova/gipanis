export function baseBaseRow(key, item) {
    let val = ''
    if(item[key] !== undefined) {
        switch(key) {
            case 'Artikeltyp':

            case 'cArtNr':
            case 'cBarcode':
            case 'fAmazonVK':
            case 'hersteller':
            case 'cName':

            case 'kArtikel':
                val = '';
                break;
            default:
                val = item[key] ;
                break;
        }
    }
    return val;
}

export function baseMainRow(key, item) {
    let val = ''
    if(item[key] !== undefined) {
        switch(key) {
            case 'ID':
                val = '';
                break;
            case 'Artikeltyp':
                val = item['ID'] + 'Hauptartikel';
                break;
            case 'fAmazonVK':
                val = item['ID'] + 'fAmazonVK';
                break;
            case 'cBarcode':
                val = item['ID'] + 'cBarcode';
                break;
            default:
                val = '';
                break;
        }
    }
    return val;
}

export function baseChilRow(key, item, index) {
    let val = '';
    let i = index+1;
    if(item[key] !== undefined) {
        switch(key) {
            case 'ID':
                val = '';
                break;
            case 'Artikeltyp':
                val = item['ID'] + item['Artikeltyp'] + i;
                break;
            case 'kArtikel':
                val = item['ID'] + 'kArtikel';
                break;
            case 'cArtNr':
                val = item['ID'] + 'cArtNr';
                break;
            case 'fAmazonVK':
                val = item['ID'] + 'fAmazonVK';
                break;
            case 'cBarcode':
                val = item['ID'] + 'cBarcode';
                break;
            default:
                val = '';
                break;
        }
    }
    return val;
}