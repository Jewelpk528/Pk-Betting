module.exports = (sequelize, DataTypes) => {
    const AnderBaharPlus = sequelize.define("tbl_ander_baher_plus", {
        id: {
            type: DataTypes.INTEGER,
            primaryKey: true,
            autoIncrement: true
        },
        room_id: {
            type: DataTypes.INTEGER,
        },
        main_card: {
            type: DataTypes.STRING,
        },
        card1: {
            type: DataTypes.STRING,
        },
        card2: {
            type: DataTypes.STRING,
        },
        card3: {
            type: DataTypes.STRING,
        },
        winning: {
            type: DataTypes.TINYINT,
        },
        winning_red_black: {
            type: DataTypes.TINYINT,
            defaultValue: 0
        },
        winning_shape: {
            type: DataTypes.TINYINT,
            defaultValue: 0
        },
        winning_ak: {
            type: DataTypes.TINYINT,
            defaultValue: 0
        },
        winning_up_down: {
            type: DataTypes.TINYINT,
            defaultValue: 0
        },
        status: {
            type: DataTypes.TINYINT,
            defaultValue: 0
        },
        winning_amount: {
            type: DataTypes.FLOAT,
            defaultValue: 0
        },
        user_amount: {
            type: DataTypes.FLOAT
        },
        comission_amount: {
            type: DataTypes.FLOAT
        },
        total_amount: {
            type: DataTypes.FLOAT
        },
        admin_profit: {
            type: DataTypes.FLOAT
        },
        end_datetime: {
            type: DataTypes.DATE
        },
        random: {
            type: DataTypes.TINYINT
        },
        added_date: {
            type: DataTypes.DATE,
            allowNull: false,
            defaultValue: DataTypes.NOW
        },
        updated_date: {
            type: DataTypes.DATE,
            allowNull: false,
            defaultValue: DataTypes.NOW
        }
    }, {
        tableName: 'tbl_ander_baher_plus',
        timestamps: true,
        createdAt: 'added_date',
        updatedAt: 'updated_date',
        indexes: [
            {
                name: 'idx_room_id',
                fields: ['room_id']
            }
        ]
    })

    return AnderBaharPlus;
}