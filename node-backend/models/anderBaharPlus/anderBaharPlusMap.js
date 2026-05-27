module.exports = (sequelize, DataTypes) => {
    const AnderBaharPlusMap = sequelize.define("tbl_ander_baher_plus_map", {
        id: {
            type: DataTypes.INTEGER,
            primaryKey: true,
            autoIncrement: true
        },
        ander_baher_plus_id: {
            type: DataTypes.INTEGER,
        },
        card: {
            type: DataTypes.STRING,
            allowNull: true,
        },
        added_date: {
            type: DataTypes.DATE,
            allowNull: false,
            defaultValue: DataTypes.NOW
        }
    }, {
        tableName: 'tbl_ander_baher_plus_map',
        timestamps: true,
        createdAt: 'added_date',
        updatedAt: false,
        indexes: [
            {
                name: 'idx_ander_baher_plus_id',
                fields: ['ander_baher_plus_id']
            }
        ]
    })

    return AnderBaharPlusMap;
}