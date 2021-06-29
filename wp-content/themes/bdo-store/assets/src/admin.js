/* eslint-disable */

acf.addAction('ready_field/name=product_category', function ( ev ) {
    const elem = ev
    let heroType = acf.getField('field_60d9abd368fb7')

    heroType.hide()

    elem.on('change', () => {
        if ( elem.val() != 'none' ) {
            heroType.val('category')
        } else {
            heroType.val('standard')
        }
    })

})

acf.addAction('ready_field/name=hero_carousel_items', function ( ev ) {
    let heroType = acf.getField('field_60d9abd368fb7')
    heroType.hide()
    heroType.val('category')
})

/* eslint-enable */