
const faker = require('faker');

function createFakeUser() {
    return {
        id: faker.datatype.uuid(),
        name: faker.name.findName(),
        email: faker.internet.email(),
        phone: faker.phone.phoneNumber(),
        address: faker.address.streetAddress(),
        city: faker.address.city(),
        country: faker.address.country()
    };
}

function createFakeProduct() {
    return {
        id: faker.datatype.uuid(),
        name: faker.commerce.productName(),
        price: faker.commerce.price(),
        description: faker.commerce.productDescription(),
        category: faker.commerce.department()
    };
}

function createFakeOrder() {
    return {
        id: faker.datatype.uuid(),
        userId: faker.datatype.uuid(),
        productId: faker.datatype.uuid(),
        quantity: faker.datatype.number({ min: 1, max: 10 }),
        totalPrice: faker.commerce.price()
    };
}

module.exports = {
    createFakeUser,
    createFakeProduct,
    createFakeOrder
};